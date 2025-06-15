<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>SRG Vedanta School</title>
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/themify-icons.css" />
    <link rel="stylesheet" type="text/css" href="css/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="revolution/css/rs6.css">
    <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
    <link rel="stylesheet" type="text/css" href="css/shortcodes.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />

</head>

<body>

    <!--HEADER STARTS-->
    <?php include 'header.php' ?>
    <!--HEADER ENDS-->


    <!-- INNER BG STARTS -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box text-left">
                        <div class="page-title-heading">
                            <h1>Article/Blog</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- INNER BG ENDS -->



    <!--site-main start-->
    <div class="site-main">
        <div class="ttm-row grid-section clearfix">
            <div class="container">
                <div class="row">
                    <?php
                    $csvFile = __DIR__ . '/blog/articles.csv';
                    $articles = [];
                    if (($handle = fopen($csvFile, 'r')) !== false) {
                        $header = fgetcsv($handle, 0, ',', '"', '\\'); // Read the header row
                        while (($row = fgetcsv($handle, 0, ',', '"', '\\')) !== false) {
                            if (count($header) == count($row)) { // Ensure row has same number of columns as header
                                $articles[] = array_combine($header, $row);
                            }
                        }
                        fclose($handle);
                    }

                    $contentDir = 'blog/content/'; // Web-accessible path to the content
                    
                    foreach ($articles as $article):
                        $title = htmlspecialchars($article['title']);
                        $jpgPath = htmlspecialchars($contentDir . $article['jpg']);
                        $pdfPath = htmlspecialchars($contentDir . $article['pdf']);
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="featured-imagebox featured-imagebox-post style3">
                                <div class="ttm-post-thumbnail featured-thumbnail">
                                    <img class="img-fluid" src="<?= $jpgPath ?>" alt="Image for <?= $title ?>">
                                </div>
                                <div class="featured-content featured-content-post">
                                    <div class="post-title featured-title">
                                        <h5><a href="<?= $pdfPath ?>" target="_blank"><?= $title ?></a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!--site-main end-->



    <!--FOOTER STARTS-->
    <?php include 'footer.php' ?>
    <!--FOOTER ENDS-->


    <!--back-to-top start-->
    <a id="totop" href="#top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!--back-to-top end-->

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.js"></script>
    <script src="js/jquery-waypoints.js"></script>
    <script src="js/jquery-validate.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/numinate.min6959.js?ver=4.9.3"></script>
    <script src="js/lazysizes.min.js"></script>
    <script src="js/main.js"></script>
    <script src="revolution/js/revolution.tools.min.js"></script>
    <script src="revolution/js/rs6.min.js"></script>
    <script src="revolution/js/slider.js"></script>
    <!-- Javascript end-->

</body>

</html>