//jshint esversion:6

const express = require("express");
const bodyParser = require("body-parser");
const ejs = require("ejs");
var _ = require('lodash')

const homeStartingContent = "Lacus vel facilisis volutpat est velit egestas dui id ornare. Semper auctor neque vitae tempus quam. Sit amet cursus sit amet dictum sit amet justo. Viverra tellus in hac habitasse. Imperdiet proin fermentum leo vel orci porta. Donec ultrices tincidunt arcu non sodales neque sodales ut. Mattis molestie a iaculis at erat pellentesque adipiscing. Magnis dis parturient montes nascetur ridiculus mus mauris vitae ultricies. Adipiscing elit ut aliquam purus sit amet luctus venenatis lectus. Ultrices vitae auctor eu augue ut lectus arcu bibendum at. Odio euismod lacinia at quis risus sed vulputate odio ut. Cursus mattis molestie a iaculis at erat pellentesque adipiscing.";
const aboutContent = "Hac habitasse platea dictumst vestibulum rhoncus est pellentesque. Dictumst vestibulum rhoncus est pellentesque elit ullamcorper. Non diam phasellus vestibulum lorem sed. Platea dictumst quisque sagittis purus sit. Egestas sed sed risus pretium quam vulputate dignissim suspendisse. Mauris in aliquam sem fringilla. Semper risus in hendrerit gravida rutrum quisque non tellus orci. Amet massa vitae tortor condimentum lacinia quis vel eros. Enim ut tellus elementum sagittis vitae. Mauris ultrices eros in cursus turpis massa tincidunt dui.";
const contactContent = "Scelerisque eleifend donec pretium vulputate sapien. Rhoncus urna neque viverra justo nec ultrices. Arcu dui vivamus arcu felis bibendum. Consectetur adipiscing elit duis tristique. Risus viverra adipiscing at in tellus integer feugiat. Sapien nec sagittis aliquam malesuada bibendum arcu vitae. Consequat interdum varius sit amet mattis. Iaculis nunc sed augue lacus. Interdum posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Pulvinar elementum integer enim neque. Ultrices gravida dictum fusce ut placerat orci nulla. Mauris in aliquam sem fringilla ut morbi tincidunt. Tortor posuere ac ut consequat semper viverra nam libero.";

const app = express();

const questions=[];
const answers=[];

let parameter;

app.set('view engine', 'ejs');

app.use(bodyParser.urlencoded({extended: true}));
app.use(express.static("public"));

app.get("/",function(req,res){

  res.render("home",{ homecontent : homeStartingContent,questions:questions,answers:answers});

 
})

app.get("/about",function(req,res){

  res.render("about",{aboutdata : aboutContent});

})

app.get("/contact",function(req,res){

  res.render("contact",{contactdata : contactContent });
})

app.get("/question",function(req,res){

  res.render("question");
})

app.post("/question",function(req,res){

 const post={
   title:req.body.posttitle,
   content: req.body.postcontent
 };

questions.push(post);

res.redirect("/");

})


app.get("/postedquestion/:topic",function(req,res){

 parameter = req.params.topic;
  
 for(var i=0;i<questions.length;i++){

  if( _.lowerCase(questions[i].title) === _.lowerCase(parameter)){

    let posttitlepost = questions[i].title;
  
    res.render("postedquestion",{PT : posttitlepost });

  }
   
 }

})

app.get("/answer",function(req,res){

  res.render("answer",{questions : questions});
})



app.get("/answerquestion/:question",function(req,res){
  parameter = req.params.question;
  for(var i=0;i<questions.length;i++)
  {

    if( _.lowerCase(questions[i].title) === _.lowerCase(parameter))
     {
  
      let questiontitle = questions[i].title;

      res.render("answerquestion",{questiontitle : questiontitle});
     }
  }
})

app.post("/answerquestion/",function(req,res){
  const ans = req.body.questionanswer;
  answers.push(ans);
  res.redirect("/"); 
})






app.listen(3000, function() {
  console.log("Server started on port 3000");
});
