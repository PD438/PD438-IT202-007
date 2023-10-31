import java.util.*;
public class Testarrays
{
 public static void main(String[] args){

 Fibonacci myfibo = new Fibonacci();
 Main mymain = new Main();
 Die[] die = new Die[6];
 for(int i = 0; i < die.length; i++){
   die[i] = new Die();
 }
 System.out.println(Arrays.toString(mymain.numberFreq()));
 System.out.println(die[0].oddDice(die));
 System.out.println(Arrays.toString(myfibo.fibo(7)));
 }
} 