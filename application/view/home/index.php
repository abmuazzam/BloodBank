<?php
    $this->start('body');
?>
<div id="slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="<?= $this->assets('slides/slide-1.jpg')?>">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= $this->assets('slides/slide-2.jpg')?>">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= $this->assets('slides/slide-3.jpg')?>">
        </div>
    </div>
    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<main class="container-fluid">
    <section class="row mt-4">
        <div class="col-12">
            <h1>What is Blood Bank?</h1>
            <p>A blood bank is a center where blood gathered as a result of blood donation is stored and preserved for later use in blood transfusion. The term "blood bank" typically refers to a division of a hospital where the storage of blood product occurs and where proper testing is performed (to reduce the risk of transfusion related adverse events). However, it sometimes refers to a collection center, and indeed some hospitals also perform collection. In blood bank blood collection,processing,testing,separation and storage is done.</p>
        </div>
    </section>
</main>
<main class="container-fluid mt-4">
    <section class="row">
        <div class="col-12 col-sm-3">
            <h4>Separation of blood</h4>
            <p>Typically, each donated unit of blood (whole blood) is separated into multiple components, such as red blood cells, plasma and platelets. Each component is generally transfused to a different individual, each with different needs.</p>
        </div>
        <div class="col-12 col-sm-3">
            <h4>Who receives blood</h4>
            <p>Accident victims, people undergoing surgery and patients receiving treatment for leukemia, cancer or other diseases, such as sickle cell disease and thalassemia, all utilize blood.</p>
        </div>
        <div class="col-12 col-sm-3">
            <h4>Giving blood to yourself</h4>
            <p>Patients scheduled for surgery may be eligible to donate blood for themselves, a process known as autologous blood donation. In the weeks before non-emergency surgery, an autologous donor may be able to donate blood that will be stored until the surgical procedure.</p>
        </div>
        <div class="col-12 col-sm-3">
            <h4>Storage of blood</h4>
            <p>Each unit of whole blood is normally separated into several components. Red blood cells may be stored under refrigeration for a maximum of 42 days, or they may be frozen for up to 10 years. Red cells carry oxygen and are used to treat anemia.</p>
        </div>
    </section>
</main>
<main class="container-fluid">
    <div class="row bg-light pb-4">
        <div class="col-12 pt-4">
            <h1>Some of our Donors</h1>
            <div class="owl-carousel owl-theme">
                <?php
                    foreach($donors as $donor){
                        switch ($donor->gender){
                            case "male":
                                $avatar = "img/male.png";
                            break;
                            case "female":
                                $avatar = "img/female.png";
                            break;
                            default:
                                $avatar = "img/default.png";
                            break;
                        }
                ?>
                        <div class="item slide_donor">
                            <img src="<?= $this->assets($avatar);?>" />
                            <ul class="list-group">
                                <li class="list-group-item mt-2">
                                    <h4><?= $donor->fullName?></h4>
                                </li>
                                <li class="list-group-item">
                                    <strong>Blood Group : </strong> <?= $donor->bloodGroup->bloodGroup;?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Address: </strong> <?= $donor->address;?>
                                </li>
                            </ul>
                        </div>
                <?php
                    }
                ?>
            </div>
            <a href="Home/SearchDonor" class="btn btn-outline-primary mt-2">Browse All Donors</a>
        </div>
    </div>
</main>
<?php
    $this->end();
    $this->start('footer');
?>
<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        autoplay: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
</script>
<?php
    $this->end();
?>
