<?php

class Post
{

    protected $idPost;
    protected $comment;

    protected $card;

    function __construct($idPost, $comment)
    {
        $this->idPost = $idPost;
        $this->comment = $comment;
    }

    function makeCard()
    {
        $card = '<div class="card mt-2 mb-2">
                 <div class="mr-3 text-right"><a href="#"><img class="mr-2 icons" src="css/icons/edit-solid.svg" alt="edit-icon" /></a><a href="#"><img class="icons" src="css/icons/times-circle-solid.svg" alt="remove-icon" /></a></div><p>';
        $card .= $this->comment;
        $card .= '</p></div>';
        $this->card = $card;
    }

    function getCard()
    {
        return $this->card;
    }

}

class PostWithSingleMedia extends Post
{

    private $media;

    function __construct($idPost, $comment, $media)
    {
        parent::__construct($idPost, $comment);
        $this->media = $media;
    }

    function makeCard()
    {
        $card = '<div class="card mt-2 mb-2">
                 <div class="mr-3 text-right"><a href="#"><img class="mr-2 icons" src="css/icons/edit-solid.svg" alt="edit-icon" /></a><a href="#"><img class="icons" src="css/icons/times-circle-solid.svg" alt="remove-icon" /></a></div>';
        switch ($this->media['typeMedia']){
            case "image":
                $card .= sprintf('<img src="%s" onclick="biggerImg(this)" alt="%s" /><p>', $this->media['mediaPath'], $this->media['mediaName']);
            break;
            case "video":
                $card .= sprintf('<video><source src="%s" type="%s" /><p></video>', $this->media['mediaPath'], $this->media['fullMediaType']);
            break;
            case "audio":
                $card .= sprintf('<audio><source src="%s" type="%s" /><p></audio>', $this->media['mediaPath'], $this->media['fullMediaType']);
            break;
        }
        $card .= $this->comment;
        $card .= '</p></div>';
        $this->card = $card;
    }

    function getCard()
    {
        return $this->card;
    }
}

class PostWithMultipleImage extends Post
{

    private $pictures;

    private $carousel;

    function __construct($idPost, $comment, $pictures)
    {
        parent::__construct($idPost, $comment);
        $this->pictures = $pictures;
    }

    function makeCard()
    {
        $this->makeCarousel();
    }

    function makeCarousel()
    {
        $carousel = '<div class="card mt-2 mb-2">
                     <div class="mr-3 text-right"><a href="#"><img class="mr-2 icons" src="css/icons/edit-solid.svg" alt="edit-icon" /></a><a href="#"><img class="icons" src="css/icons/times-circle-solid.svg" alt="remove-icon" /></a></div>
                     <div id="carouselIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
                     <ol class="carousel-indicators">';

        for ($i = 0; $i < count($this->pictures); $i++) {
            if($i==0){
                $carousel .= '<li data-target="#carouselIndicators" data-slide-to="' . $i . '" class="active"></li>';
            }else{
                $carousel .= '<li data-target="#carouselIndicators" data-slide-to="' . $i . '" class=""></li>';
            }
        }

        $carousel .= '</ol>
                      <div class="carousel-inner">';

        foreach ($this->pictures as $key => $p) {
            if($key==0){
                $carousel .= '<div class="carousel-item active">';
            }else {
                $carousel .= '<div class="carousel-item ">';
            }
            $carousel .= sprintf('<img src="meida/%s" onclick="biggerImg(this)" class="d-block w-100" alt="%s" />', $p['mediaPath'], $p['nameMedia']);
            $carousel .= '</div>';
        }
        $carousel .= '</div>
                      <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                      </a>
                      </div><p>';
        $carousel .= $this->comment;
        $carousel .= '</p></div>';

        $this->carousel = $carousel;
    }

    function getComment()
    {
        return $this->pictures;
    }

    function getCard()
    {
        return $this->carousel;
    }

    function getCarousel()
    {
        return $this->carousel;
    }
}