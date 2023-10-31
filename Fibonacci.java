public class Fibonacci {
   public static int[] fibo(int total) {
      if (total <= 0) {
         return new int [0];
      }
      
      int[] fibonacci = new int[total];
      fibonacci[0] = 1;
      
      if (total > 1) {
         fibonacci[1] = 1;
      }
      
      int i = 2;
      //created a while loop here to display the fibo sequence
      while (i < total) {
         fibonacci[i] = fibonacci[i - 1] + fibonacci[i - 2];
         i++;
      }
      
      return fibonacci;
}

public static void main(String[] args) {
      int total = 13;
      int[] result = fibo(total);
      
      System.out.println("First" + total + " Fibonacci numbers:");
      
      }
         
}