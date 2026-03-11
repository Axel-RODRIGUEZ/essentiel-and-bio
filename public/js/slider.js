document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.favorite_slider');
    if (!container) return;

    const originals = Array.from(container.querySelectorAll('.favorite_object:not(.clone)'));
    if (originals.length === 0) return;

    const firstItem = originals[0];
    const style = window.getComputedStyle(firstItem);
    const itemWidth = firstItem.getBoundingClientRect().width + parseFloat(style.marginLeft) + parseFloat(style.marginRight);
    
    const stopPoint = itemWidth * originals.length;
    const neededWidth = stopPoint + container.clientWidth;
    let currentTotalWidth = stopPoint;

    while (currentTotalWidth < neededWidth + itemWidth) {
        originals.forEach(item => {
            const clone = item.cloneNode(true); 
            clone.classList.add('clone'); 
            container.appendChild(clone);
            currentTotalWidth += itemWidth;
        });
    }

    let scrollInterval;

    function startAutoScroll() {
        scrollInterval = setInterval(() => {
            container.scrollLeft += 1;

            if (container.scrollLeft >= stopPoint) {
                container.scrollLeft -= stopPoint; 
            }
        }, 20);
    }

    startAutoScroll();

    container.addEventListener('mouseenter', () => {
        clearInterval(scrollInterval);
    });

    container.addEventListener('mouseleave', () => {
        startAutoScroll();
    });

    container.addEventListener('scroll', () => {
        if (container.scrollLeft >= stopPoint) {
            container.scrollLeft -= stopPoint;
        } else if (container.scrollLeft <= 0) {
            container.scrollLeft += stopPoint; 
        }
    });
});