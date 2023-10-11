<template>

    <router-view/>
<div class="svg-container">
    <svg viewBox="0 0 202.9 45.5" >
      <clipPath id="menu" clipPathUnits="objectBoundingBox" transform="scale(0.0049285362247413 0.021978021978022)">
        <path  d="M6.7,45.5c5.7,0.1,14.1-0.4,23.3-4c5.7-2.3,9.9-5,18.1-10.5c10.7-7.1,11.8-9.2,20.6-14.3c5-2.9,9.2-5.2,15.2-7
          c7.1-2.1,13.3-2.3,17.6-2.1c4.2-0.2,10.5,0.1,17.6,2.1c6.1,1.8,10.2,4.1,15.2,7c8.8,5,9.9,7.1,20.6,14.3c8.3,5.5,12.4,8.2,18.1,10.5
          c9.2,3.6,17.6,4.2,23.3,4H6.7z"/>
      </clipPath>
    </svg>
  </div>
   <menu class="menu">
            <router-link to="/">
              <button class="menu__item active" style="--bgColorItem: #78c8cc;" >
                <svg class="icon" viewBox="0 0 24 24">
                  <path d="M3.8,6.6h16.4"/>
                  <path d="M20.2,12.1H3.8"/>
                  <path d="M3.8,17.5h16.4"/>
                </svg>
              </button>
            </router-link>
          <router-link to="/cal">
            <button class="menu__item" style="--bgColorItem: #ff5192;" > 
            <svg class="icon" viewBox="0 0 24 24" >
              <path  d="M5.1,3.9h13.9c0.6,0,1.2,0.5,1.2,1.2v13.9c0,0.6-0.5,1.2-1.2,1.2H5.1c-0.6,0-1.2-0.5-1.2-1.2V5.1
                C3.9,4.4,4.4,3.9,5.1,3.9z"/>
              <path  d="M4.2,9.3h15.6"/>
              <path  d="M9.1,9.5v10.3"/>
                  </svg>
          </button>
            </router-link>
          <router-link to="/daily">

          <button class="menu__item" style="--bgColorItem: #4343f5;" >
            <svg class="icon" viewBox="0 0 24 24">
            <path  d="M3.4,11.9l8.8,4.4l8.4-4.4"/>
            <path  d="M3.4,16.2l8.8,4.5l8.4-4.5"/>
            <path  d="M3.7,7.8l8.6-4.5l8,4.5l-8,4.3L3.7,7.8z"/>
                  </svg>

          </button>
            </router-link>


          <div class="menu__border"></div>

        </menu>
</template>
<script>
export default {
    data() {
        return {
            
        }
    },
    components: {
    },
    methods: {
        
    },
    mounted() {
        // Designed by:  Mauricio Bucardo
        // Original image:
        // https://dribbble.com/shots/5619509-Animated-Tab-Bar

        "use strict"; 

        const body = document.body;
        const bgColorsBody = ["#78c8cc", "#ff96bd", "#9999fb", "#ffe797", "#cffff1"];
        const menu = body.querySelector(".menu");
        const menuItems = menu.querySelectorAll(".menu__item");
        const menuBorder = menu.querySelector(".menu__border");
        let activeItem = menu.querySelector(".active");

        function clickItem(item, index) {

            menu.style.removeProperty("--timeOut");
            
            if (activeItem == item) return;
            
            if (activeItem) {
                activeItem.classList.remove("active");
            }

            
            item.classList.add("active");
            body.style.backgroundColor = bgColorsBody[index];
            activeItem = item;
            offsetMenuBorder(activeItem, menuBorder);
            
            
        }

        function offsetMenuBorder(element, menuBorder) {

            const offsetActiveItem = element.getBoundingClientRect();
            const left = Math.floor(offsetActiveItem.left - menu.offsetLeft - (menuBorder.offsetWidth  - offsetActiveItem.width) / 2) +  "px";
            menuBorder.style.transform = `translate3d(${left}, 0 , 0)`;

        }

        offsetMenuBorder(activeItem, menuBorder);

        menuItems.forEach((item, index) => {

            item.addEventListener("click", () => clickItem(item, index));
            
        })

        window.addEventListener("resize", () => {
            offsetMenuBorder(activeItem, menuBorder);
            menu.style.setProperty("--timeOut", "none");
        });
            }
}
</script>

<style>
body{
    direction: rtl;
    /*
    background: #eeaeca;
    background: radial-gradient(circle, #eeaeca 0%, #94bbe9 100%);
    */
}
#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
html {
  box-sizing: border-box;
}

*,
*:before,
*:after {
  box-sizing: inherit;
}

* {
  outline: 0;
}

body {
  /*
  background: linear-gradient(45deg, #13495f, #764be2, #8373c6, #77d3b9);
  background-attachment: fixed;
  */
  height: 100vh;
  padding: 3rem 0;
  margin: 0;
  color: #555;
  font-family: "Lato", sans-serif;
  font-size: 14px;
}

.container {
  width: 90%;
  margin: auto;
}

.mobile-wrapper {
  background: #fff;
  /* relative with .today-box::before*/
  z-index: 1;
  /*positive*/
  position: relative;

  width: 380px;
  min-height: 100%;
  margin: auto;
  padding: 10px 0 20px;
  border-radius: 10px;
  box-shadow: 0px 10px 30px -10px #000;
  overflow: hidden;
  margin-bottom: 4rem;
}

.header {
  padding-bottom: 15px;
  margin-bottom: 40px;
}
.header .container {
  position: relative;
}
.header .container span {
  color: #444;
  font-family: "Ramabhadra";
  font-size: 21px;
  font-weight: 700;
}
.header .container h1 {
  margin-top: 5px;
  color: #919294;
  font-size: 13px;
  font-weight: 300;
}
.header .container .menu-toggle {
  width: 25px;
  height: 25px;
  background: #fff;
  padding: 24px;
  border-radius: 50%;
  direction: rtl;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 10px 30px -14px #000;
  position: absolute;
  top: 0;
  left: 0;
  cursor: pointer;
}
.header .container .menu-toggle span {
  display: block;
  width: 25px;
  height: 2px;
  background: #777;
  border-radius: 2px;
  transition: all 300ms ease;
}
.header .container .menu-toggle span:not(:last-child) {
  margin-bottom: 5px;
}
.header .container .menu-toggle span:first-child {
  width: 20px;
}
.header .container .menu-toggle span:last-child {
  width: 15px;
}
.header .container .menu-toggle:hover span:first-child, .header .container .menu-toggle:hover span:last-child {
  width: 100%;
}
.header .container::before {
  content: "";
  display: block;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-left-color: #e8e8e8;
  position: absolute;
  bottom: -13px;
  right: 0px;
}
.header .container::after {
  content: "";
  display: block;
  width: calc(100% - 10px);
  height: 2px;
  background-color: #e8e8e8;
  position: relative;
  top: 8px;
}

.add-event-button {
  display: flex;
  align-items: center;
  margin-right: auto;
  border: 0;
  padding: 0;
  background: linear-gradient(to left, #485fed, rgba(255, 44, 118, 0.25)), #485fed;
  border-radius: 50px;
  cursor: pointer;
  box-shadow: 0px 0px 40px -9px #485fed;
}
.add-event-button:active {
  position: relative;
  top: 2px;
  right: 2px;
}
.add-event-button .add-event-button__title {
  color: #fff;
  padding: 0 18px 0 23px;
  text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
  font-family: "Lato";
  font-size: 15px;
  font-weight: 600;
}
.add-event-button .add-event-button__icon {
  display: inline-block;
  background: rgba(255, 255, 255, 0.1);
  padding: 0 17px 0 12px;
  height: 100%;
}
.add-event-button .add-event-button__icon i {
  margin: 0;
  color: #fff;
  font-size: 25px;
  padding: 13px 0;
}
html {

    box-sizing: border-box;
    --bgColorMenu : #1d1d27;
    --duration: .7s;    

}

html *,
html *::before,
html *::after {

    box-sizing: inherit;

}

body{
    
    margin: 0;
    display: flex;
    height: 100vh;
    align-items: center;
    background-color: #ffb457;
    -webkit-tap-highlight-color: transparent;
    transition: background-color var(--duration);

}

.menu{

    margin: 0;
    display: flex;
    /* Works well with 100% width  */
    width: 100%;
    font-size: 1.5em;
    padding: 0 2.85em;
    position: fixed;
    bottom:0;
    align-items: center;
    justify-content: center;
    background-color: var(--bgColorMenu);
    z-index: 10;
    width: 380px;
}

.menu__item{
    
    all: unset;
    flex-grow: 1;
    z-index: 100;
    display: flex;
    cursor: pointer;
    position: relative;
    border-radius: 50%;
    align-items: center;
    will-change: transform;
    justify-content: center;
    padding: 0.55em 1.25em 0.85em;
    transition: transform var(--timeOut , var(--duration));
    
}

.menu__item::before{
    
    content: "";
    z-index: -1;
    width: 3.2em;
    height: 3.2em;
    border-radius: 50%;
    position: absolute;
    transform: scale(0);
    transition: background-color var(--duration), transform var(--duration);
    
}


.menu__item.active {

    transform: translate3d(0, -.8em , 0);

}

.menu__item.active::before{
    
    transform: scale(1);
    background-color: var(--bgColorItem);

}

.icon{
    
    width: 2.6em;
    height: 2.6em;
    stroke: white;
    fill: transparent;
    stroke-width: 1pt;
    stroke-miterlimit: 10;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 400;
    
}

.menu__item.active .icon {

    animation: strok 1.5s reverse;
    
}

@keyframes strok {

    100% {

        stroke-dashoffset: 400;

    }

}

.menu__border{

    left: 0;
    bottom: 99%;
    width: 4.9em;
    height: 1.0em;
    z-index: 10;
    position: absolute;
    clip-path: url(#menu);
    will-change: transform;
    background-color: var(--bgColorMenu);
    transition: transform var(--timeOut , var(--duration));
    
}

.svg-container {

    width: 0;
    height: 0;
}


@media screen and (max-width: 50em) {
    .menu{
        font-size: .8em;
    }
}
</style>