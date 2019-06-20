/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package ayobot;

/**
 *
 * @author fitechbot
 */
import java.awt.Font;
import java.io.*;
import java.util.logging.Level;
import java.util.logging.Logger;
public class ProcessStream 
{
   private byte[] bWrite ;
   private Font theFont;
   private FileOutputStream os;
   public ProcessStream( )
   {
   bWrite = new byte[5];
   for(int x=0; x<5; x++)
   {
   bWrite[x]=12;
   }
   
   }
   
    public Object readObjFromFile(String FileDir) throws ClassNotFoundException, IOException
    {
    File objFile = new File(FileDir);
    if(objFile .exists())
    {
    FileInputStream fileIn;
    ObjectInputStream in;
    fileIn = new FileInputStream(FileDir);
    in = new ObjectInputStream(fileIn);
    Object obj =in.readObject();
    return obj;
    } 
    else
    {
    return null;       
    }
    }
    
    
    
    
    //out.writeObject(theFont);
    //Object obj =in.readObject();
    ////System.out.println(obj.toString()); 
       
   
   
    
   
   
   
    public void writeToObjFile(Object obj,String FileDir)
    {
    //theFont = new Font("TimesRoman",Font.BOLD,24);  
    try 
    { 
    try 
    (
    FileOutputStream fileOut = new FileOutputStream(FileDir); 
    ObjectOutputStream out = new ObjectOutputStream(fileOut)
    ) 
    {
    out.writeObject(obj);
    } 
    }
    catch(IOException i) 
    { 
    i.printStackTrace(); 
    }
    
    }
    
    public void WriteToDataFile() throws IOException
    {
    DataInputStream d = new DataInputStream(new FileInputStream("test.txt"));
    BufferedReader r=new BufferedReader(new InputStreamReader(d)); 
    DataOutputStream out= new DataOutputStream(new FileOutputStream("test2.txt")); 
    String count; 
    while((count = r.readLine())!=null) 
    { 
    String u = count.toUpperCase();
    System.out.println(u); 
    out.writeBytes(u +"\n"); 
    } 
    d.close(); 
    out.close();
    }
           
   public void WriteToFile() throws IOException 
   {
   
   BufferedReader inputStream = null;
        PrintWriter outputStream = null;

        try {
            inputStream = new BufferedReader(new FileReader("xanadu.txt"));
            outputStream = new PrintWriter(new FileWriter("characteroutput.txt"));

            String l;
            while ((l = inputStream.readLine()) != null) {
                outputStream.println(l);
            }
        } finally {
            if (inputStream != null) {
                inputStream.close();
            }
            if (outputStream != null) {
                outputStream.close();
            }
        }
    }

   
   
  public String readTxtFile(File file)
  { 
   
  //File file = new File("text.txt");
  StringBuffer fileBuffer;
  fileBuffer = null;
  String fileString;
  fileString = null;
  String line;
  line = null;
  try 
  {
  
  FileReader in;
  in = new FileReader(file);
   System.out.println(" hello world");
  BufferedReader brd = new BufferedReader(in);
  fileBuffer = new StringBuffer();
 
  while ((line= brd.readLine())!=null)
  {
  
  fileBuffer.append(line).append( System.getProperty("line.separator"));
  
  }
  in.close();
  fileString = fileBuffer.toString();
  System.out.println(fileString+ " hello world");
  }
  catch (IOException e)
  {  
  return null;
  }
  return fileString;
  }
  
   public static void main(String args[]) throws IOException
   {
    ProcessStream ps=new ProcessStream( );
    //ps.readTxtFile();  //exterbal file as arguement
    //ps.WriteToFile();
    //ps.WriteToDataFile(); 
    //ps.writeToObjFile();
    String a= "hello World";
    //ps.readObjFromFile(a);
   }
    
}
