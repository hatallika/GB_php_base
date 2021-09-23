<?php
function getGallery(){
    return array_splice(scandir('gallery_img/small'),2);
}