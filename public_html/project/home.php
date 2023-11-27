<?php
require(__DIR__."/../../partials/nav.php");
?>
<h1>Home</h1>
<?php
if(is_logged_in()){
    flash("Welcome, " . get_user_email());
}
else{
    flash("You're not logged in.  Log in Dude");
}
<div class="container-fluid">
    <div class="h-50 p-5 text-bg-dark rounded-3">
        <h1>Welcome to Random Cookbook!</h1>
        <p>Thank you for your interest in our mission. We are a organization with a goal to find you the best recipes while saving your wallet. Please give this a try and you will be satisfied.  I guarantee it. </p>
        <p class="text-center"><a class="btn btn-primary btn-lg" href="<?php get_url("browse.php", true); ?>" role="button">Let us Begin!!!!</a></p>
    </div>
</div>
<?php
require(__DIR__."/../../partials/footer.php");
?>