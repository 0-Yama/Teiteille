/*
 * QR Code generator demo (C)
 *
 * Run this command-line program with no arguments. The program
 * computes a demonstration QR Codes and print it to the console.
 *
 * Copyright (c) Project Nayuki. (MIT License)
 * https://www.nayuki.io/page/qr-code-generator-library
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * - The above copyright notice and this permission notice shall be included in
 *   all copies or substantial portions of the Software.
 * - The Software is provided "as is", without warranty of any kind, express or
 *   implied, including but not limited to the warranties of merchantability,
 *   fitness for a particular purpose and noninfringement. In no event shall the
 *   authors or copyright holders be liable for any claim, damages or other
 *   liability, whether in an action of contract, tort or otherwise, arising from,
 *   out of or in connection with the Software or the use or other dealings in the
 *   Software.
 */
#include <stdbool.h>
#include <stddef.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "qrcodegen.h"
#include "qrcodegen.c"

//----------------------------------------------------------
#include <stdint.h>
#include <malloc.h>
#define _height 928
#define _width 928
#define _bitsperpixel 24
#define _planes 1
#define _compression 0
#define _pixelbytesize _height*_width*_bitsperpixel/8
#define _filesize _pixelbytesize+sizeof(bitmap)
#define _xpixelpermeter 0x130B //2835 , 72 DPI
#define _ypixelpermeter 0x130B //2835 , 72 DPI
#define pixel 0x00
#pragma pack(push,1)
typedef struct{
    uint8_t signature[2];
    uint32_t filesize;
    uint32_t reserved;
    uint32_t fileoffset_to_pixelarray;
} fileheader;
typedef struct{
    uint32_t dibheadersize;
    uint32_t width;
    uint32_t height;
    uint16_t planes;
    uint16_t bitsperpixel;
    uint32_t compression;
    uint32_t imagesize;
    uint32_t ypixelpermeter;
    uint32_t xpixelpermeter;
    uint32_t numcolorspallette;
    uint32_t mostimpcolor;
} bitmapinfoheader;
typedef struct {
    fileheader fileheader;
    bitmapinfoheader bitmapinfoheader;
} bitmap;
#pragma pack(pop)
//-------------------------------------------------

// Function prototypes
static void doBasicDemo(char *text);
static void doVarietyDemo(void);
static void doSegmentDemo(void);
static void doMaskDemo(void);
static void printQr(const uint8_t qrcode[]);


// The main application program.
int main(void) {
	doBasicDemo("azertyuiopmlkjhgfdsqwxcvbnazertyuiopmlkjhggfdsqxwcv");
	//doVarietyDemo();
	//doSegmentDemo();
	//doMaskDemo();
	return EXIT_SUCCESS;
}



/*---- Demo suite ----*/

// Creates a single QR Code, then prints it to the console.
static void doBasicDemo(char *text) {
                                     // User-supplied text max 17 char
	enum qrcodegen_Ecc errCorLvl = qrcodegen_Ecc_LOW;  // Error correction level

	// Make and print the QR Code symbol
	uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
	uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
	bool ok = qrcodegen_encodeText(text, tempBuffer, qrcode, errCorLvl,
		qrcodegen_VERSION_MIN, qrcodegen_VERSION_MAX, qrcodegen_Mask_AUTO, true);
	if (ok)
		printQr(qrcode);
}

/*---- Utilities ----*/

// Prints the given QR Code to the console.
static void printQr(const uint8_t qrcode[]) {

    FILE *fp = fopen("QR.bmp","wb");
    bitmap *pbitmap  = (bitmap*)calloc(1,sizeof(bitmap));
    uint8_t *pixelbuffer = (uint8_t*)malloc(_pixelbytesize);
    strcpy(pbitmap->fileheader.signature,"BM");
    pbitmap->fileheader.filesize = _filesize;
    pbitmap->fileheader.fileoffset_to_pixelarray = sizeof(bitmap);
    pbitmap->bitmapinfoheader.dibheadersize =sizeof(bitmapinfoheader);
    pbitmap->bitmapinfoheader.width = _width;
    pbitmap->bitmapinfoheader.height = _height;
    pbitmap->bitmapinfoheader.planes = _planes;
    pbitmap->bitmapinfoheader.bitsperpixel = _bitsperpixel;
    pbitmap->bitmapinfoheader.compression = _compression;
    pbitmap->bitmapinfoheader.imagesize = _pixelbytesize;
    pbitmap->bitmapinfoheader.ypixelpermeter = _ypixelpermeter ;
    pbitmap->bitmapinfoheader.xpixelpermeter = _xpixelpermeter ;
    pbitmap->bitmapinfoheader.numcolorspallette = 0;
    fwrite (pbitmap, 1, sizeof(bitmap),fp);
    //memset(pixelbuffer,pixel2,_pixelbytesize);


    int size           = qrcodegen_getSize(qrcode);
	int border         = 4;
    int sizeWithborder = size + border * 2;

    char codetest[sizeWithborder*sizeWithborder];

    int w=0;
	long long k=0;
	for (int y = -border; y < size + border; y++) {
        //for(int m=0; m<32; m++) {
            for (int x = -border; x < size + border; x++) {
                //fputs((qrcodegen_getModule(qrcode, x, y) ? "##" : "  "), stdout);
                if(qrcodegen_getModule(qrcode, x, y)){
                    codetest[w]='n';

                } else {
                    codetest[w]='b';

                }
                w++;
                //printf("%c ",testQrCode[y+4][x+4]);
            }
            //fputs("\n", stdout);
       // }
	}

    w=0;
	for (int i=0; i<sizeWithborder; i++) {
        for(int m=0; m<32; m++) {
            for (int j=0; j<sizeWithborder; j++) {
            //printf("%c ",codetest[w]);

                if(codetest[w]=='n'){
                    for(int n=0; n<32; n++) {
                        pixelbuffer[k]=0x00;
                        pixelbuffer[k+1]=0x00;
                        pixelbuffer[k+2]=0x00;

                        k=k+3;
                    }
                } else {
                    for(int n=0; n<32; n++) {
                        pixelbuffer[k]=0xFF;
                        pixelbuffer[k+1]=0xFF;
                        pixelbuffer[k+2]=0xFF;

                        k=k+3;
                    }
                }
                printf("%d %d\n",i,j);

                w++;

            }
            w=29*i;
		}
		//fputs("\n", stdout);
	}

    fwrite(pixelbuffer,1,_pixelbytesize,fp);

    fclose(fp);
    free(pbitmap);
    free(pixelbuffer);

    /*FILE * QR = fopen("qr.txt","wb ,ccs=UTF-16LE");
	int size = qrcodegen_getSize(qrcode);
	int border = 4;
	for (int y = -border; y < size + border; y++) {
		for (int x = -border; x < size + border; x++) {
            fputs((qrcodegen_getModule(qrcode, x, y) ? "# " : "  "), stdout);
            //printf("%c \\ %d \n",'#355','#355');
            //fprintf("%d",(qrcodegen_getModule(qrcode, x, y) ? 1 : 0), &QR);
            //printf ("\x80\n");
            //printf ("\128\n");
            if(qrcodegen_getModule(qrcode, x, y)){
                fwrite("██",sizeof(char),1,QR);
            } else {
                fwrite(" ",sizeof(char),1,QR);
            }
		}
		fputs("\n", stdout);
		fwrite("\n",sizeof(char),1,QR);
	}
	fputs("\n", stdout);
	fwrite("\n",sizeof(char),1,QR);

	fclose(QR);*/
}
