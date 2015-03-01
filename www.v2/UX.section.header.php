<div class="x visible-xs">XS</div>
<div class="x visible-sm">SM</div>
<div class="x visible-md">MD</div>
<div class="x visible-lg">LG</div>

<div class="container header">
    <div class="row languages text-right">
<!--		<a href="language-fi.html" class="<?php if (getLang() == 'fi') echo 'active'; ?>">Suomi</a>
            <a href="language-se.html" class="<?php if (getLang() == 'se') echo 'active'; ?>">Svenska</a>
            <a href="language-en.html" class="<?php if (getLang() == 'en') echo 'active'; ?>">English</a>-->

        <?php
        $querySr = $_SERVER['QUERY_STRING']; //checks if parameters exits
        if (isset($querySr)) {
            //print "Query found" . $querySr;
            //if query string is empty
            if ($querySr == "") {
                // print "no parameters";
                ?>
                <a href="?lang=suomi">Suomi</a>
                <a href="?lang=svenska">Svenska</a>
                <a href="?lang=english">English</a>
                <?php
            } else {
                if (!isset($_GET['lang'])) {
                    ?>
                    <a href="<?php echo $_SERVER['PHP_SELF'] . "?" . $querySr; ?>&lang=suomi">Suomi</a>
                    <a href="<?php echo $_SERVER['PHP_SELF'] . "?" . $querySr; ?>&lang=svenska">Svenska</a>
                    <a href="<?php echo $_SERVER['PHP_SELF'] . "?" . $querySr; ?>&lang=english">English</a>

                    <?php
                } else {
                    $fquery = explode("&", $querySr);
                    //print_r($fquery);
                    if (count($fquery) > 1) {
                        ?>
                        <a href="<?php echo $_SERVER['PHP_SELF'] . "?" . $fquery[0]; ?>&lang=suomi">Suomi</a>
                        <a href="<?php echo $_SERVER['PHP_SELF'] . "?" . $fquery[0]; ?>&lang=svenska">Svenska</a>
                        <a href="<?php echo $_SERVER['PHP_SELF'] . "?" . $fquery[0]; ?>&lang=english">English</a>
                        <?php
                    } else {
                        ?>
                        <a href="?lang=suomi">Suomi</a>
                        <a href="?lang=svenska">Svenska</a>
                        <a href="?lang=english">English</a>
                        <?php
                    }
                }
            }
        } else {
            print "Query not found" . $querySr;
            ?>
            <a href="?lang=suomi">Suomi</a>
            <a href="?lang=svenska">Svenska</a>
            <a href="?lang=english">English</a>
            <?php
        }
        ?>

    </div>
    <div class="row logo text-center">
        <div class="col-xs-24">
            <a href="index.php">
                <img src="images/logo.png" />
            </a>
        </div>
    </div>

    <div class="row search">
        <div class="col-xs-24 col-sm-18 col-sm-offset-3 col-md-14 col-md-offset-5 col-lg-12 col-lg-offset-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Mistä haet?">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <img src="images/ico-search.png"/>
                    </button>
                </span>
            </div>
        </div>
    </div> 

    <div class="row title">
        <h1 class="text-center">iPhone kuoret</h1>
    </div>
</div>