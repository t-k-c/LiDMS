<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 20/07/2018
 * Time: 18:45
 */
include '../modules/imports.php';
if ( CookieManager::userLoggedIn() ) {
	?>
    <html>
    <head>
		<?php include '../modules/head.php'; ?>
    </head>
    <body>
	    <?php include '../modules/primary-foot.php'; ?>
    </body>
    </html>

	<?php
} else {
//	redirect to error page
	$_SESSION['error_msg'] = 'You are not allowed to access this page';
	die( "<script>window.location = '../error-page'</script>" );
}