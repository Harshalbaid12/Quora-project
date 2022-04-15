

  
   
    var cards = document.getElementsByClassName('card');
   // console.log(cards);
    
    Array.from(cards).forEach(card => {
        card.addEventListener("click",function(event){
              // console.log("card clicked",event);
               var targetcard = event.target;
               const question = targetcard.children[1].innerText;
               window.location.href="viewanswer.php?question="+question;
        });
    });

