<?php
if (!file("variables.env")) {
    $baseURL = file("../variables.env")[0];
} else {
    $baseURL = file("variables.env")[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    echo $stylesheets;
    ?>

    <!-- Include IonIcon Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Include Flaticon Icons -->
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-bold-straight/css/uicons-bold-straight.css" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css" />
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css" />

    <!-- Include the SweetAlert2 Library -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo $baseURL ?>/js/sweetAlertFunctions.js"></script>
    <!-- Include ResponsiveVoice -->
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=9EndP8Cp"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo $baseURL ?>/images/favicon.ico">
    <title>
        <?php echo $title ?>
        - Ορθοπαίγνια</title>
    <script>
        let baseURL = window.location.pathname.split("/")[1].replace(/(?:\r\n|\r|\n)/g, "");
    </script>
</head>