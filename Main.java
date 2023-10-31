class Main
{
   public static int[] numberFreq()
   {
      int[] frequencies = new int[6];
      for (int i = 0; i<100; i++)
      {
         int value = (int) (Math.random() *6);
         frequencies[value]++;
      }
      return frequencies;
   }
   
   public static void main(String[] args)
   {
      
   
   }
}        