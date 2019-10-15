const image = new window.Image();
image.src = require("../assets/cases/iphone.png");
image.onload = () => {
  this.image = image;
};
export default image;