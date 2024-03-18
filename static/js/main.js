/////* Script Main */////

// Event listener for scroll events
document.addEventListener('DOMContentLoaded', () => {
    // Select the header elements
    const bottomPart = document.querySelector('#header');

    // Function to add or remove the 'fixed' class based on scrolling
    const toggleFixedHeader = () => {
        // console.log(window.scrollY);
        if (window.scrollY>= 80) {
            bottomPart.classList.add('fixed');
        } else {
            bottomPart.classList.remove('fixed');
        }
        return;
    }
    // const responsiveHide = () => {
    //     const screenWidth = window.innerWidth;
    //     if(screenWidth > 992){
    //         const menuListElement = document.querySelector(".mobileHeaderMenu");
    //         menuListElement.classList.remove("toggled");
    //         mobileMenuToggleState = false;
    //     }
    //     return;
    // }

    // Event listener for scroll events
    window.addEventListener('scroll', toggleFixedHeader);
    window.addEventListener('load', toggleFixedHeader);
    // window.addEventListener('resize', responsiveHide);
});

var mobileMenuToggleState = false;
const toggleMobileMenu = () => {
    const menuListElement = document.querySelector(".mobileHeaderMenu");
    switch (mobileMenuToggleState) {
        case false: 
            menuListElement.classList.add("toggled");
            mobileMenuToggleState = true;
            break;
        case true: 
            menuListElement.classList.remove("toggled");
            mobileMenuToggleState = false;
            break;
    }
    return;
};