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
                            <h1>Books</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- INNER BG ENDS -->



    <!--site-main start-->
    <?php
    /* ------------------  BOOK LIST  ------------------ */
    /* Configuration */
    $csvFile = __DIR__ . '/books/books.csv';   // path to the metadata file
    $coverDir = 'books/covers';                 // web-visible folder
    // $sizes = [200, 400, 600, 800, 1000, 1200, 1600, 2400]; // eight sizes you keep
    $sizes = [400]; // eight sizes you keep
    $defaultW = 400;                            // which size to show in <img src=...>
    
    /* Read CSV into $books */
    /* Read CSV into $books */
    $books = [];
    if (($handle = fopen($csvFile, 'r')) !== false) {
        // ⇩ add size, delimiter, enclosure, escape
        $header = fgetcsv($handle, 0, ',', '"', '\\');
        while (($row = fgetcsv($handle, 0, ',', '"', '\\')) !== false) {
            if (count($header) == count($row)) {
                $books[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
    ?>

    <?php
    // Initialize an array to hold books to be displayed
    $displayBooks = [];

    // Check for category or tag filters in the URL
    $filterCategory = $_GET['category'] ?? null;
    $filterTag = $_GET['tag'] ?? null;

    if ($filterCategory || $filterTag) {
        foreach ($books as $book) {
            $match = true;
            if ($filterCategory) {
                $bookCategories = array_filter(array_map('trim', preg_split('/[|,]/', $book['categories'])));
                if (!in_array($filterCategory, $bookCategories)) {
                    $match = false;
                }
            }
            if ($filterTag && $match) { // Only check tags if category filter is met or not present
                $bookTags = array_filter(array_map('trim', preg_split('/[|,]/', $book['tags'])));
                if (!in_array($filterTag, $bookTags)) {
                    $match = false;
                }
            }
            if ($match) {
                $displayBooks[] = $book;
            }
        }
    } else {
        // If no filter is set, display all books
        $displayBooks = $books;
    }
    ?>

    <style>
        /* minimal styling – tweak / move to your stylesheet later */
        .books-grid {
            display: grid;
            /* Use grid for responsive layout */
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
            /* Add some padding around the grid */
        }

        .book-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            /* Lighter border */
            display: flex;
            /* Use flexbox for internal layout */
            flex-direction: column;
            /* Stack content vertically */
            justify-content: space-between;
            /* Distribute space */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            /* Enhanced subtle shadow */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            /* Add hover effect */
            position: relative;
            /* For positioning the details panel */
            overflow: hidden;
            /* Hide overflowing details panel content */
        }

        .book-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 0.8rem;
            /* Space below image */
            object-fit: contain;
            /* Ensure image fits without cropping */
            max-height: 200px;
            /* Limit image height for consistency */
        }

        .price {
            font-weight: bold;
            margin: 0.5rem 0;
            font-size: 1.25rem;
            /* Larger price */
            color: #007bff;
            /* Highlight price */
        }

        .book-card h4 {
            /* make title modest but bold */
            font-size: 1rem;
            /* roughly normal-text size (16 px) */
            font-weight: 700;
            /* bold */
            margin: 0.4rem 0;
            /* Adjust margin */
            /* a bit of breathing room */
            font-size: 1.15rem;
            /* Slightly larger title */
            color: #333;
            /* Darker title color */
            white-space: nowrap;
            /* Prevent title from wrapping */
            overflow: hidden;
            /* Hide overflow */
            text-overflow: ellipsis;
            /* Add ellipsis for long titles */
            position: relative;
            /* For tooltip positioning */
        }

        .meta {
            font-size: .9rem;
            color: #555;
            font-size: .85rem;
            /* Slightly smaller meta */
            color: #777;
            /* Lighter meta color */
            margin-bottom: 0.8rem;
            /* Space below meta */
        }

        /* --- prettier details panel --- */
        .details p {
            margin: 0 0 .6rem 0;
        }

        /* --- Tooltip on Title Hover --- */
        .book-card h4[title]:hover::after,
        .book-card h4[title]:hover::before {
            opacity: 1;
            visibility: visible;
            transition-delay: 0.3s;
        }

        .book-card h4[title]::after {
            content: attr(title);
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            line-height: 1.4;
            white-space: normal;
            text-align: center;
            width: max-content;
            max-width: 220px;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }

        .book-card h4[title]::before {
            content: '';
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-bottom: -1px;
            border: 6px solid transparent;
            border-top-color: #333;
            z-index: 101;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }

        /* --- details panel --- */
        .book-card .details {
            position: absolute;
            bottom: 0;
            /* Start from the bottom */
            left: 0;
            right: 0;
            background: #f8f9fa;
            /* Light background for details */
            border-top: 1px solid #e0e0e0;
            /* Separator line */
            border-radius: 0 0 8px 8px;
            /* Match card border-radius */
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.05);
            /* Subtle shadow above */
            padding: 1rem;
            font-size: 0.9rem;
            line-height: 1.4;
            text-align: left;
            opacity: 0;
            transform: translateY(100%);
            /* Start hidden below the card */
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
            pointer-events: none;
            /* Disable interaction when hidden */
            z-index: 10;
            max-height: 80%;
            /* Limit height of details panel */
            overflow-y: auto;
            /* Enable scrolling for long descriptions */
        }

        .book-card.open .details {
            opacity: 1;
            transform: translateY(0);
            /* Slide up to visible position */
            pointer-events: auto;
            /* Enable interaction when open */
        }

        .badge {
            display: inline-block;
            background: #e8eefc;
            color: #3856a7;
            font-size: .75rem;
            font-weight: 600;
            border-radius: 12px;
            padding: .2rem .6rem;
            /* Slightly more padding */
            margin: .15rem .25rem .15rem 0;
            /* Adjust margin */
            text-decoration: none;
            /* Remove underline from links */
            transition: background-color 0.2s ease;
        }

        .badge.tag {
            background: #f5e9d8;
            color: #a45a00;
        }

        .badge:hover {
            background-color: #d0d8f0;
            /* Darker on hover */
        }

        .badge.tag:hover {
            background-color: #e0d4c0;
        }

        /* --- Filter heading --- */
        .filter-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #ddd;
            padding: 1rem;
            /* Add padding */
            background-color: #f8f9fa;
            /* Light background */
            border-radius: 8px;
            /* Rounded corners */
            text-align: center;
        }

        .filter-header p {
            margin: 0 0 0.25rem;
            font-size: 1rem;
            font-weight: normal;
            margin: 0 0 0.5rem;
            /* Adjust margin */
            font-size: 1.1rem;
            /* Slightly larger font */
            color: #333;
        }

        .filter-header a {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .filter-header a:hover {
            background-color: #0056b3;
        }

        /* New button style */
        .view-details-btn {
            background-color: #28a745;
            /* Green color */
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            margin-top: 1rem;
            /* Space above the button */
            transition: background-color 0.2s ease;
            width: fit-content;
            /* Adjust width to content */
            align-self: center;
            /* Center the button in flex container */
            text-decoration: none;
            /* If it's an anchor */
        }

        .view-details-btn:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        /* Hide the button when details are open */
        .book-card.open .view-details-btn {
            display: none;
        }

        /* Add a close button for the details panel */
        .details-close-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #555;
            cursor: pointer;
            line-height: 1;
            padding: 0.2rem;
            transition: color 0.2s ease;
        }

        .details-close-btn:hover {
            color: #000;
        }

        /* Ensure the summary content is always visible */
        .book-summary {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
            /* Allow summary to take available space */
            padding-bottom: 1rem;
            /* Space for the button */
        }

        /* Adjust card height when details are open to accommodate content */
        .book-card.open {
            height: auto;
            /* Allow height to expand */
            min-height: 350px;
            /* Ensure a minimum height for open state */
        }

        /* Adjust for smaller screens */
        @media (max-width: 768px) {
            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 1rem;
            }

            .book-card {
                padding: 0.8rem;
            }

            .book-card h4 {
                font-size: 1rem;
            }

            .book-card .price {
                font-size: 1.1rem;
            }

            .view-details-btn {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }
        }
    </style>

    <div class="container"> <!-- NEW wrapper -->

        <?php if ($filterCategory): ?>
            <div class="filter-header">
                <p>Showing books in category: <strong><?= htmlspecialchars($filterCategory) ?></strong></p>
                <a href="books.php">Show All Books</a>
            </div>
        <?php elseif ($filterTag): ?>
            <div class="filter-header">
                <p>Showing books with tag: <strong><?= htmlspecialchars($filterTag) ?></strong></p>
                <a href="books.php">Show All Books</a>
            </div>
        <?php endif; ?>
        <div class="books-grid">
            <?php foreach ($displayBooks as $b): ?>
                <?php
                $slug = trim($b['cover_basename']);           // e.g. Divya-Prabandha-Mala-Kusuma
                $img = "{$coverDir}/{$slug}_{$defaultW}.jpg";
                $srcset = implode(', ', array_map(
                    fn($w) => "{$coverDir}/{$slug}_{$w}.jpg {$w}w",
                    $sizes
                ));
                $price = number_format($b['price_paise'] / 100, 2); // Rupees & Paise
                ?>
                <div class="book-card">
                    <div class="book-summary">
                        <img src="<?= htmlspecialchars($img) ?>" srcset="<?= htmlspecialchars($srcset) ?>"
                            sizes="(max-width: 600px) 50vw, 220px" alt="Cover of <?= htmlspecialchars($b['title']) ?>">

                        <h4 title="<?= htmlspecialchars($b['title']) ?>"><?= htmlspecialchars($b['title']) ?></h4>
                        <p class="price">₹<?= $price ?></p>
                        <button class="view-details-btn">View Details</button>
                    </div>

                    <!-- hidden panel that shows on hover / tap -->
                    <div class="details">
                        <button class="details-close-btn">&times;</button>
                        <?php if (!empty($b['description'])): ?>
                            <p><?= nl2br(htmlspecialchars($b['description'])) ?></p> <!-- nl2br converts newlines to <br> -->
                        <?php endif; ?>
                        <?php
                        // split on | or , then trim each fragment
                        $categories = array_filter(array_map('trim', preg_split('/[|,]/', $b['categories'])));
                        $tags = array_filter(array_map('trim', preg_split('/[|,]/', $b['tags'])));
                        ?>
                        <p>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <a href="books.php?category=<?= urlencode($category) ?>"
                                        class="badge"><?= htmlspecialchars($category) ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </p>
                        <p>
                            <?php if (!empty($tags)): ?>
                                <?php foreach ($tags as $tag): ?>
                                    <a href="books.php?tag=<?= urlencode($tag) ?>"
                                        class="badge tag"><?= htmlspecialchars($tag) ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div> <!-- /container -->

    <?php /* -------------- END BOOK LIST -------------- */ ?>
    <script>
        /* tap-to-open / tap-again-or-outside to close */
        document.addEventListener('click', function (e) {
            const clickedButton = e.target.closest('.view-details-btn');
            const clickedCloseButton = e.target.closest('.details-close-btn');
            const clickedCard = e.target.closest('.book-card');

            if (clickedButton) {
                // Tapped on a "View Details" button
                const card = clickedButton.closest('.book-card');
                if (card) {
                    // Close all other open cards
                    document.querySelectorAll('.book-card.open').forEach(function (c) {
                        if (c !== card) {
                            c.classList.remove('open');
                        }
                    });
                    // Toggle the clicked card
                    card.classList.toggle('open');
                }
                e.stopPropagation(); // Prevent document click listener from immediately closing it
            } else if (clickedCloseButton) {
                // Tapped on the close button inside details
                const card = clickedCloseButton.closest('.book-card');
                if (card) {
                    card.classList.remove('open');
                }
                e.stopPropagation(); // Prevent document click listener from immediately closing it
            } else if (!clickedCard) {
                // Tapped outside any book card
                document.querySelectorAll('.book-card.open')
                    .forEach(c => c.classList.remove('open'));
            }
        }, true);
    </script>

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