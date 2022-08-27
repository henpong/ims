<script>

  let date = new Date();
  let hours = date.getHours();
  let greet;

  if(hours>=0 && hours<=12){
    greet = document.write("Good Morning");
  }else if(hours>=12 && hours<=18){
    greet = document.write("Good Afternoon");
  }else if(hours>=18 && hours<=23){
    greet = document.write("Good Evening");
  }else{
    greet = document.write("Greet me");
  }
  
</script>