

jQuery(document).ready(function($) {
    var rand = Math.floor((Math.random() * quotes.length) + 1);
    var quote = quotes[rand].quote;
    var author = quotes[rand].author;
    $( "#quotes" ).text(quote);    
    $( "#author" ).text(" —" + author);    
    $( ".quotes" ).fadeIn( "slow", function() {});   
    window.setInterval(function(){

        var rand = Math.floor((Math.random() * quotes.length) + 1);
        var quote = quotes[rand].quote;
        var author = quotes[rand].author;

        $( ".quotes" ).fadeOut( "slow", function() {
            $( "#quotes" ).text(quote);    
            $( "#author" ).text(" —" + author);    
            $( ".quotes" ).fadeIn( "slow", function() {});
        });

    }, 5000);
        
});
            
var quotes = [
    {"quote" : "Only mothers can think of the future — because they give birth to it in their children.",
    "autoher" : "Maxim Gorky"},

    {"quote" : "Our mothers always remain the strangest, craziest people we\'ve ever met.",
    "author" : "Marguerite Duras"},

    {"quote" : "Biology is the least of what makes someone a mother.",
    "author" : "Oprah Winfrey"},

    {"quote" : "My mother... she is beautiful, softened at the edges and tempered with a spine of steel. I want to grow old and be like her.",
    "author" : "Jodi Picoult"},

    {"quote" : "Such a mysterious business, motherhood. How brave a woman must be to embark on it.",
    "author" : "M.L. Stedman"},

    {"quote" : "All that I am or ever hope to be, I owe to my angel mother.",
    "author" : "Abraham Lincoln"},

    {"quote" : "The best thing she was, was her children.",
    "author" : "Toni Morrison"},

    {"quote" : "A suburban mother’s role is to deliver children obstetrically once, and by car forever after.",
    "author" : "Peter De Vries"},

    {"quote" : "A mother is not a person to lean on, but a person to make leaning unnecessary.",
    "author" : "Dorothy Canfield Fisher"},

    {"quote" : "Most mothers are instinctive philosophers.",
    "author" : "Harriet Beecher Stowe"},

    {"quote" : "A mother knows what her child's gone through, even if she didn't see it herself.",
    "author" : "Pramoedya Ananta Toer"},

    {"quote" : "You sacrificed for us. You're the real MVP.",
    "author" : "Kevin Durant"},

    {"quote" : "If the whole world were put into one scale, and my mother in the other, the whole world would kick the beam.",
    "author" : "Henry Bickersteth"},

    {"quote" : "God could not be everywhere, and therefore he made mothers.",
    "author" : "Rudyard Kipling"},

    {"quote" : "It has been a terrible, horrible, no good, very bad day. My mom says some days are like that.",
    "author" : "Judith Viorst"},

    {"quote" : "Men are what their mothers made them.",
    "author" : "Ralph Waldo Emerson"},

    {"quote" : "Making the decision to have a child — it's momentous. It is to decide forever to have your heart go walking outside your body.",
    "author" : "Elizabeth Stone"},

    {"quote" : "Mothers are all slightly insane.",
    "author" : "J.D. Salinger"},

    {"quote" : "A mother is a mother from the moment her baby is first placed in her arms until eternity. It didn't matter if her child were three, thirteen, or thirty.",
    "author" : "Sarah Strohmeyer"},

    {"quote" : "Mothers can forgive anything! Tell me all, and be sure that I will never let you go, though the whole world should turn from you.",
    "author" : "Louisa May Alcott"},




    ];
