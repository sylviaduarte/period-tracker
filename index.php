<?php 

include ('include/initialize.php');

echoHeader("Sylvia Duarte");

?>

<div id="pfp">
      <img class="pfp" src="icons/me3-modified.png" />
    </div>
    <h1 id="name">Sylvia Duarte</h1>
    <p class="description">
      I'm an upcoming junior at Washington University in St. Louis majoring in
      Computer Science and Economics.
      <!-- In my free time, I like playing with my cat, watching Disney movies, 
            and learning about the art of homecooking. -->
    </p>

<?php 

echoPageLink ("Learn more about me", "here!", "www.google.com" );

echoButtons();
echoFooter();
