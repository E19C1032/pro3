/* ======================================================================   */
/* File Name       : trimForIcon.js                                         */
/* Encoding        : UTF-8                                                  */
/* Creation Date   : 2021/12/21                                             */
/* Version         : 1.2                                                    */

/* Copyright © 2021 manju All rights reserved.                              */

/* This source code or any portion thereof must not be                      */
/* reproduced or used in any manner whatsoever.                             */
/* ======================================================================   */





const imageMimeType = {
    jpg: "image/jpeg",
    jpeg: "image/jpeg",
    png: "image/png"
}

const imageType = {
    "image/jpg": "jpeg",
    "image/jpeg": "jpeg",
    "image/png": "png"
}



class Trim {

    /**
     * トリミングコンテナを生成します。
     * @param {Object} option オプション
     */
    constructor(option) {
        this.conWidth = 640;
        this.conHeight = 480;
        this.frameSize = 320;
        this.outSize = 320;
        this.sizeMagn = this.outSize / this.frameSize;
        this.edgeOffsetX = 160;
        this.edgeOffsetY = 30;
        this.outMimeType = "image/png";
        this.callbacks = {
            ontrim: e => {}
        }

        this.resultObj = {
            detail: {
                result: null,
                type: null,
                mimeType: null
            }
        }

        // init option
        if(option != undefined) {
            this.outMimeType = (typeof option.type != undefined) && imageMimeType[option.type]; // type
            this.sizeMagn = option.size == undefined ? 1.0 : option.size / this.frameSize;      // size
            this.outSize = option.size == undefined ? 320 : option.size;                        // out size
            this.edgeType = option.edge == undefined ? "square" : option.edge;                  // edge
        }

        // generate elements or object
        let bg = document.getElementById("container-trim-for-icon");
        this.bg = bg;
        let container = document.createElement("div");
        this.container = container;
        let header = document.createElement("div");
        let main = document.createElement("div");
        let footer = document.createElement("div");
        let btnTrim = document.createElement("div");
        let btnTrimText = document.createElement("p");
        let parentBtnClose = document.createElement("div");
        let btnClose = document.createElement("img");
        let overlay = document.createElement("div");
        let parentEdge = document.createElement("div");
        let squareEdge = document.createElement("div");
        this.squareEdge = squareEdge;
        let canvas = document.createElement("canvas");
        this.canvas = canvas;
        let ctx = canvas.getContext("2d");
        this.ctx = ctx;
        let inpRangeMagn = document.createElement("input");
        this.inpRangeMagn = inpRangeMagn;
        let imgZoomOut = document.createElement("img");
        let imgZoomIn = document.createElement("img");
        let canvasResult = document.createElement("canvas");
        this.canvasResult = canvasResult;
        let ctxResult = canvasResult.getContext("2d");
        this.ctxResult = ctxResult;

        // specify id or class
        container.id = "child-container-trim-for-icon";
        header.id = "header-trim-for-icon";
        main.id = "main-trim-for-icon";
        footer.id = "footer-trim-for-icon";
        btnTrim.id = "button-trim-trim-for-icon";
        btnTrimText.id = "button-trim-text-trim-for-icon";
        parentBtnClose.id = "parent-button-close-trim-for-icon";
        btnClose.id = "button-close-trim-for-icon";
        overlay.id = "overlay-trim-for-icon";
        parentEdge.id = "parent-edge-trim-for-icon";
        squareEdge.id = "square-edge-trim-for-icon";
        canvas.id = "canvas-trim-for-icon";
        inpRangeMagn.id = "input-range-magn-trim-for-icon";
        imgZoomOut.id = "image-zoom-out-trim-for-icon";
        imgZoomIn.id = "image-zoom-in-trim-for-icon";
        canvasResult.id = "canvas-result-trim-for-icon";

        // set up
        parentEdge.appendChild(squareEdge);
        btnTrim.appendChild(btnTrimText);
        parentBtnClose.appendChild(btnClose);
        header.appendChild(btnTrim);
        header.appendChild(parentBtnClose);
        main.appendChild(overlay);
        main.appendChild(parentEdge);
        main.appendChild(canvas);
        main.appendChild(canvasResult);
        footer.appendChild(imgZoomOut)
        footer.appendChild(inpRangeMagn);
        footer.appendChild(imgZoomIn);
        container.appendChild(header);
        container.appendChild(main);
        container.appendChild(footer);
        bg.appendChild(container);

        // button
        btnTrimText.innerText = "切り取り";
        btnClose.src = `${ root }icon/close.svg`;
        btnClose.width = 40;
        btnClose.height = 40;

        // input range
        inpRangeMagn.type = "range";
        inpRangeMagn.step = 0.01;
        inpRangeMagn.value = 1.0;

        // image
        imgZoomOut.src = `${ root }icon/zoom_out.png`;
        imgZoomIn.src = `${ root }icon/zoom_in.png`;
        imgZoomOut.width = 24;
        imgZoomIn.width = 24;

        // canvas
        canvas.style.top = 0 + "px";
        canvas.style.left = 0 + "px";
        canvasResult.width = this.outSize;
        canvasResult.height = this.outSize;

        // edge
        switch(this.edgeType) {
            case "square":
                squareEdge.classList.add("square");
                squareEdge.classList.remove("circle");

                break;
            case "circle":
                squareEdge.classList.add("circle");
                squareEdge.classList.remove("square");

                break;
            default:
                squareEdge.classList.add("square");
                squareEdge.classList.remove("circle");

                break;
        }



        // event
        btnTrim.addEventListener("click", e => {
            this.trim();
        });

        btnClose.addEventListener("click", e => {
            canvas.style.left = 0;
            canvas.style.top = 0;
            this.close();
        });

        btnClose.addEventListener("drag", e => {
            e.preventDefault();
        });

        main.addEventListener("wheel", e => {
            e.preventDefault();

            if(e.deltaY > 0) {
                this.inpRangeMagn.value = Number(this.inpRangeMagn.value) - 0.1;
            } else {
                this.inpRangeMagn.value = Number(this.inpRangeMagn.value) + 0.1;
            }

            let value = Number(this.inpRangeMagn.value);

            canvas.style.width = canvas.width * value + "px";
            canvas.style.height = canvas.height * value + "px";

            if(canvas.offsetLeft + canvas.clientWidth < this.edgeOffsetX + this.frameSize) {
                canvas.style.left = this.edgeOffsetX + this.frameSize - canvas.clientWidth + "px";
            }
            if(canvas.offsetTop + canvas.clientHeight < this.edgeOffsetY + this.frameSize) {
                canvas.style.top = this.edgeOffsetY + this.frameSize - canvas.clientHeight + "px";
            }
        });

        let mousedown = false;
        let clickOffsetX = 0;
        let clickOffsetY = 0;
        main.addEventListener("mousedown", e => {
            clickOffsetX = e.clientX - canvas.offsetLeft;
            clickOffsetY = e.clientY - canvas.offsetTop;
            mousedown = true;
        });

        main.addEventListener("mousemove", e => {
            if(mousedown) {
                let left = e.clientX - clickOffsetX;
                let top = e.clientY - clickOffsetY;
                let flagL = true;
                let flagT = true;

                if(left > this.edgeOffsetX) {
                    canvas.style.left = this.edgeOffsetX + "px";
                    clickOffsetX += e.movementX;
                    flagL = false;
                }
                if(left + canvas.clientWidth < this.edgeOffsetX + this.frameSize) {
                    canvas.style.left = this.edgeOffsetX + this.frameSize - canvas.clientWidth + "px";
                    clickOffsetX += e.movementX;
                    flagL = false;
                }
                if(top > this.edgeOffsetY) {
                    canvas.style.top = this.edgeOffsetY + "px";
                    clickOffsetY += e.movementY;
                    flagT = false;
                }
                if(top + canvas.clientHeight < this.edgeOffsetY + this.frameSize) {
                    canvas.style.top = this.edgeOffsetY + this.frameSize - canvas.clientHeight + "px";
                    clickOffsetY += e.movementY;
                    flagT = false;
                }

                if(flagL) canvas.style.left = left + "px";
                if(flagT) canvas.style.top = top + "px";
            }
        });

        main.addEventListener("mouseup", e => {
            mousedown = false;
        });

        main.addEventListener("mouseleave", e => {
            mousedown = false;
        });

        canvas.addEventListener("drag", e => {
            e.preventDefault();
        });

        canvas.addEventListener("mousemove", e => {
            e.preventDefault();
        });

        inpRangeMagn.addEventListener("input", e => {
            let value = Number(inpRangeMagn.value);

            canvas.style.width = canvas.width * value + "px";
            canvas.style.height = canvas.height * value + "px";

            if(canvas.offsetLeft + canvas.clientWidth < this.edgeOffsetX + this.frameSize) {
                canvas.style.left = this.edgeOffsetX + this.frameSize - canvas.clientWidth + "px";
            }
            if(canvas.offsetTop + canvas.clientHeight < this.edgeOffsetY + this.frameSize) {
                canvas.style.top = this.edgeOffsetY + this.frameSize - canvas.clientHeight + "px";
            }
        });

        imgZoomOut.addEventListener("click", e => {
            inpRangeMagn.value = Number(inpRangeMagn.value) - 0.01;

            let value = Number(inpRangeMagn.value);

            canvas.style.width = canvas.width * value + "px";
            canvas.style.height = canvas.height * value + "px";

            if(canvas.offsetLeft + canvas.clientWidth < this.edgeOffsetX + this.frameSize) {
                canvas.style.left = this.edgeOffsetX + this.frameSize - canvas.clientWidth + "px";
            }
            if(canvas.offsetTop + canvas.clientHeight < this.edgeOffsetY + this.frameSize) {
                canvas.style.top = this.edgeOffsetY + this.frameSize - canvas.clientHeight + "px";
            }
        });

        imgZoomIn.addEventListener("click", e => {
            inpRangeMagn.value = Number(inpRangeMagn.value) + 0.01;

            let value = Number(inpRangeMagn.value);

            canvas.style.width = canvas.width * value + "px";
            canvas.style.height = canvas.height * value + "px";

            if(canvas.offsetLeft + canvas.clientWidth < this.edgeOffsetX + this.frameSize) {
                canvas.style.left = this.edgeOffsetX + this.frameSize - canvas.clientWidth + "px";
            }
            if(canvas.offsetTop + canvas.clientHeight < this.edgeOffsetY + this.frameSize) {
                canvas.style.top = this.edgeOffsetY + this.frameSize - canvas.clientHeight + "px";
            }
        });

        imgZoomIn.addEventListener("drag", e => {
            e.preventDefault();
        });

        imgZoomOut.addEventListener("drag", e => {
            e.preventDefault();
        });



        // custom event
        this.eventTrim = new CustomEvent("trim", this.resultObj);
    }

    /**
     * ウインドウを開いて画像を読み込む。
     * @param {*} url 画像のURL
     */
    open(url) {
        if(url == undefined || url == "") {
            throw new Error("url is empty.");
        }

        this.bg.classList.add("active");

        this.image = new Image();
        this.image.onload = () => {
            this.canvas.width = this.image.width;
            this.canvas.height = this.image.height;
            this.canvas.style.left = this.edgeOffsetX + "px";
            this.canvas.style.top = this.edgeOffsetY + "px";

            let sizeMagn = this.image.width > this.image.height ? Math.round(this.frameSize / this.image.height * 100) / 100 : Math.round(this.frameSize / this.image.width * 100) / 100;
            this.inpRangeMagn.min = sizeMagn;
            this.inpRangeMagn.max = sizeMagn * 2.0;
            this.inpRangeMagn.value = sizeMagn;
            this.canvas.style.width = this.image.width * sizeMagn + "px";
            this.canvas.style.height = this.image.height * sizeMagn + "px";

            this.ctx.drawImage(this.image, 0, 0);
        }
        this.image.src = url;
    }

    /**
     * ウインドウを閉じる。
     */
    close() {
        this.bg.classList.remove("active");
    }

    /**
     * 画像をトリミングする。
     */
    trim() {
        this.conWidth = this.container.clientWidth;
        this.conHeight = this.container.clientHeight;
        this.edgeOffsetX = this.squareEdge.offsetLeft;
        this.edgeOffsetY = this.squareEdge.offsetTop;

        let cvsOffsetX = this.canvas.offsetLeft;
        let cvsOffsetY = this.canvas.offsetTop;
        let value = 1 / Number(this.inpRangeMagn.value);

        this.ctxResult.clearRect(0, 0, this.frameSize * this.sizeMagn, this.frameSize * this.sizeMagn);
        this.ctxResult.drawImage(
            this.image, 
            (this.edgeOffsetX - cvsOffsetX) * value, (this.edgeOffsetY - cvsOffsetY) * value, 
            this.frameSize * value, this.frameSize * value, 
            0, 0, 
            this.outSize, this.outSize);

        // detail
        this.resultObj.detail.result = this.canvasResult.toDataURL(this.outMimeType);
        this.resultObj.detail.mimeType = this.resultObj.detail.result.split(":")[1].split(";")[0];
        this.resultObj.detail.type = imageType[this.resultObj.detail.mimeType];

        // fire event
        this.canvas.dispatchEvent(this.eventTrim);
    }

    /**
     * @param {(e: any) => void} callback
     */
    set ontrim(callback) {
        if(this.callbacks.ontrim != null) this.canvas.removeEventListener("trim", this.callbacks.ontrim);
        this.callbacks.ontrim = callback;
        this.canvas.addEventListener("trim", callback);
    }

}





let root;
window.addEventListener("load", () => {
    let scripts = document.getElementsByTagName("script");
    let i = scripts.length;
    while(i--) {
        let match = scripts[i].src.match(/(^|.*\/)trimForIcon\.js.*$/);
        if(match) {
            root = match[1];
            break;
        }
    }
});
