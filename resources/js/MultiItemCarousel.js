class MultiItemCarousel {
    #speed = 300;
    #interval;
    #intervalId;

    #scrollPosition = 0;
    #carouselInner;
    #items;
    #itemCount;

    constructor(elementId, options) {
        this.#init(elementId, options);
    }

    #init(elementId, options) {
        if (options?.speed) this.#speed = options.speed;
        this.#carouselInner = $(`${elementId} .carousel-inner`);
        this.#items = $(`${elementId} .carousel-item`);
        this.#itemCount = this.#items.length;

        // event click on next button
        $(`${elementId} .carousel-control-next`).click(() => {
            this.next();

            this.#resetInterval();
        });
    
        // event click on prev button
        $(`${elementId} .carousel-control-prev`).click(() => {
            this.prev();

            this.#resetInterval();
        });

        $(elementId).on("swiperight", () => {
            this.prev();

            this.#resetInterval();
        });
        
        $(elementId).on("swipeleft", () => {
            this.next();

            this.#resetInterval();
        });

        // auto move
        if (options?.interval && options.interval > 0) {
            this.#interval = options.interval;

            this.#intervalId = setInterval(() => {
                this.next();
            }, options.interval);
        }
    }

    next() {
        if (this.#shouldGoBack()) {
            this.#scrollPosition = 0;
        } else {
            this.#scrollPosition += 1;
        }

        const itemWidth = this.#items.innerWidth();
        this.#moveCarousel(this.#scrollPosition * itemWidth);
    }

    prev() {
        if (this.#scrollPosition > 0) {
            this.#scrollPosition -= 1;
        } else {
            this.#scrollPosition = this.#getEndPosition();
        }

        const itemWidth = this.#items.innerWidth();
        this.#moveCarousel(this.#scrollPosition * itemWidth);
    }

    #moveCarousel(position) {
        this.#carouselInner.animate({ 
            scrollLeft: position
        }, this.#speed);
    }

    #shouldGoBack() {
        const carouselWidth = this.#carouselInner.width();
        const itemPerSlide = Math.floor(carouselWidth / this.#items.innerWidth());

        return this.#scrollPosition >= this.#itemCount - itemPerSlide;
    }

    #getEndPosition() {
        const carouselWidth = this.#carouselInner.width();
        const itemPerSlide = Math.floor(carouselWidth / this.#items.innerWidth());

        return this.#itemCount - itemPerSlide;
    }

    #resetInterval() {
        if (this.#intervalId) {
            clearInterval(this.#intervalId);

            this.#intervalId = setInterval(() => {
                this.next();
            }, this.#interval);
        }
    }
}