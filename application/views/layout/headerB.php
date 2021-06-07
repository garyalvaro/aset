        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

<!-- END HEADER  -->

<?php
if(!$this->session->userdata('LoggedIN'))
    redirect('Account');
?>
