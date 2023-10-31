public class Die
{
   //attributes
   private int faceValue; 
   
   //default constructor
   public Die(){
      faceValue =2;
   }
   //non-default constructor
   public Die(int initialFace){
      faceValue = initialFace;
   }
   
   //method roll
   public void roll()
   {
      faceValue = (int)(Math.random()*6) +1;
   }
   
   //odd dice method
   public int oddDice(Die[] dice) {
      int j = 0;
      int i = 0;
      for( i = 0; i< dice.length; i++) {
         dice[i].roll();  
         if(dice[i].getFaceValue() %2 != 0)
            j++;
      }
   return j;
  }
   //getter method
   public int getFaceValue(){
      return faceValue;
   }
   
   //setter method
   public void setFaceValue(int newFace){
      faceValue = newFace;
   }
   
   //toString method
   public String toString(){
      return "Die with face equal to " + faceValue;
   }
   
   public boolean equals(Die otherDie){
      return faceValue == otherDie.getFaceValue();
   }
   
   public int compareTo(Die otherDie){
      if (faceValue > otherDie.faceValue){
         return 1;
      }
      else if (faceValue < otherDie.faceValue){
         return -1;
      }
      else{
         return 0;
      }
   }
}