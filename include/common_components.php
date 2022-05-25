<?php


    
//each button has a name (class), link, image

// function createFooterButton ($name, $hyperlink, $imgLink) {
//     return "
//     <a class = 'button' href = '".$hyperlink."'>
//         <img class = '".$name."' src = '".$imgLink."' />
//     </a>
//     "
// }

// function compileButtons {
//     $buttonList = 
//         createFooterButton (linkedin, https://www.linkedin.com/in/sylvia-duarte-9b30851b5/, icons/icons8-linkedin-circled-90.png);
//         createFooterButton (mail, mailto:d.sylvia@wustl.edu, icons/icons8-circled-envelope-90.png);
//         createFooterButton (github, https://github.com/sylviaduarte, icons/icons8-linkedin-circled-90.png);
// }

//function for link additions

function getButtons() {
    return "
        <div class='buttons'>
            <a href='https://www.linkedin.com/in/sylvia-duarte-9b30851b5/'>
                <img class='linkedin' src='icons/icons8-linkedin-circled-90.png' />
            </a>
            <a href='mailto:d.sylvia@wustl.edu'>
                <img class='mail' src='icons/icons8-circled-envelope-90.png' />
            </a>
            <a href='https://github.com/sylviaduarte'>
                <img class='github' src='icons/icons8-github-90.png' />
            </a>
        </div>
    ";
}

function echoPageLinks () {
    echo "
    
    
    "
}
function addPageLink ($textWithoutLink, $textWithLink, $path) {
    return "
        <h2>".$textWithoutLink." <a href = '".$path.">".$textWithLink."</a></h2>
    "
    ;
}

function echoPageLink($textWithoutLink, $textWithLink, $path) {
    echo addPageLink ($textWithoutLink, $textWithLink, $path);
}

#make variables for href links & icons (arr?)
function getHeader ($title) {
    return "
        <html>
            <head>
            <title>".$title."</title>
            <link rel='stylesheet' href='style.css' />
            <link rel='icon' href='icons/icons8-heart-24.png' />
        </head>
        <body>
    ";
}

function getFooter () {
    return " 
        </body>
    </html>
    ";
}

function echoButtons () {
    echo getButtons();
}

function echoFooter () {
    echo getFooter();
}

function echoHeader ($title) {
    echo getHeader ($title);
}






