
document.addEventListener('DOMContentLoaded', () => {
    let container = document.querySelector('.favorite_slider');
    let scrollInterval;
    let firstItem = container.querySelector('.favorite_object');
    let favoriteObjects = container.querySelectorAll('.favorite_object:not(.clone)');
    let favoritesCount = favoriteObjects.length;
    let itemWidth = firstItem.getBoundingClientRect().width;
    let style = window.getComputedStyle(firstItem);
    let marginLeft = parseFloat(style.marginLeft);
    let marginRight = parseFloat(style.marginRight);
    let totalItemWidth = itemWidth + marginLeft + marginRight;
    let stopPoint = totalItemWidth * favoritesCount;
    
    
    function startAutoScroll() {
    scrollInterval = setInterval(function() {
        container.scrollLeft += 1;

        if (container.scrollLeft >= stopPoint) {
            container.scrollLeft = 1; 
        }
    }, 20);
}
    if (container && firstItem) {
        startAutoScroll();

        container.addEventListener('mouseenter', () => {
            clearInterval(scrollInterval); 
        });

        container.addEventListener('mouseleave', () => {
            startAutoScroll();
        });
    }
    container.addEventListener('scroll', () => {
    if (container.scrollLeft >= stopPoint) {
        container.scrollLeft = 1;
    } 

    else if (container.scrollLeft <= 0) {
        container.scrollLeft = stopPoint - 1; 
    }
})
    container.scrollLeft = totalItemWidth;
});