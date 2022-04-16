

  
   
    var cards = document.getElementsByClassName('card');
   // console.log(cards);
    const url="";
    Array.from(cards).forEach(card => {
        card.addEventListener("click",function(event){
              // console.log("card clicked",event);
               var targetcard = event.target;
               const question = targetcard.children[1].innerText;
               url = "viewanswer.php?question="+question;
               window.location.href=url;
        });
    });


   