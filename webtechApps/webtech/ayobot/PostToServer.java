package ayobot;
//import hellotrio.LoadImage;
import java.awt.image.BufferedImage;
import java.io.*;
import java.net.*;
import java.nio.file.Files;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
//import static java.nio.file.StandardCopyOption.*;


public class PostToServer
{
    private String genCharset;
    private String CRLF;
    private   String boundary;
    private URLConnection genConnection;
    private  URI genUri;
    private  URL genUrl;
    private URLConnection genUrlCon;
    private OutputStream genOutput;
    private OutputStreamWriter genOutputStreamWriter;
    private Map<String,List<String>> as;
    private List<String> serverCookies;
    private String cookieKey;
    private String cookieValue;
    public String[] username ;
    public String[] hashed_username ;
    public String[] fullname;
    public String[] dp;
    public String[] sex;
    public int delimiter;
    private String cookiesDir="appDb/cookieManager";
    public ProcessStream pS;
    File objFile;
    public PostToServer() 
    {
    //String imageFileName="pic.jpg";
    //LoadImage loadImage = new LoadImage(imageFileName);
    //bi= loadImage.getImage();
    //imageStr= loadImage.getImageDetails();
    genCharset= "UTF-8";
    CRLF = "\r\n";
    boundary = Long.toHexString(System.currentTimeMillis()); 
    cookieKey=null;
    cookieValue=null;
    serverCookies=null;
    delimiter=10;
    username = new String[delimiter];
    fullname = new String[delimiter];
    dp = new String[delimiter];
    pS=new ProcessStream();
    objFile = new File(cookiesDir);
    }

    public void getUrlConnection(Boolean Y_N)
    {
    try 
    {
    genConnection = genUrl.openConnection();
    System.out.println(genUrl.getProtocol());
    if(Y_N==true)
    {
    genConnection.setDoOutput(true);   
    }
    //genConnection =(HttpURLConnection) genConnection;
    //return genConnection;
    } 
    catch 
    (IOException ex) 
    {
    //Logger.getLogger(PostToServer.class.getName()).log(Level.SEVERE, null, ex);
    
    System.out.println("Connection could not be made" + ex );
    
    }
    }
    
    public void setServerUrl(String uri)  // sets & returns the url of the server //URL 
    {
    try 
    {
    genUri = new URI(uri);
    } 
    catch (URISyntaxException ex) 
    {
    Logger.getLogger(PostToServer.class.getName()).log(Level.SEVERE, null, ex);
    }
    try 
    {
    genUrl = genUri.toURL();
    //return genUrl;
    } 
    catch (MalformedURLException ex) 
    {
    Logger.getLogger(PostToServer.class.getName()).log(Level.SEVERE, null, ex);
    }
    }
    
    public void getSeverCookies()
    {   
        String key;
        String value;
        if(serverCookies==null)
        {
        serverCookies=genConnection.getHeaderFields().get("Set-Cookie");
       if(objFile .exists()==false)
       {
       pS.writeToObjFile(serverCookies,cookiesDir);
       }
       }
        //System.out.println(serverCookies.toString());  
        
        
     
        
        
        }
    
     public void setSeverCookies()
     {
      objFile = new File(cookiesDir);
      if(objFile .exists())
      {
      try 
      {    
      Object obj= pS.readObjFromFile(cookiesDir);
      serverCookies=(List<String>)obj;
      String finalcookies="";
      serverCookies.size();
      for (String cookie : serverCookies) 
        {
        //System.out.println(cookie.split(";", 2)[0]+" cookie size:"+serverCookies.size()); 
        //genConnection.addRequestProperty("Cookie", cookie.split(";", 2)[0]);
        //genConnection.addRequestProperty("Cookie","FITECHBOT_SESSION=uerm474q9ab0co80tcphfpt0p3");//this set the server session from the client, making the server to remeber this client no mater the days that have passed since that particular user login
        finalcookies+=cookie.split(";", 2)[0];
        if(serverCookies.size()> 1)
        {
        finalcookies+=";";
        }
        } 
      System.out.println(finalcookies); 
      //genConnection.addRequestProperty("Cookie","remember_login=51ee05722a1e719d74e724536073273b;FITECHBOT_SESSION=3im8id0fvpftv8l0fcufo814t4");
      genConnection.addRequestProperty("Cookie",finalcookies);
   }
   catch (ClassNotFoundException ex) 
   {
   Logger.getLogger(WebTechMainClass.class.getName()).log(Level.SEVERE, null, ex);
   } 
   catch (IOException ex) 
   {
   Logger.getLogger(WebTechMainClass.class.getName()).log(Level.SEVERE, null, ex);
   }
   }
   else
   {
       if(serverCookies!=null)
        {
        //List<String> cookies = genConnection.getHeaderFields().get("Set-Cookie");
          
        for (String cookie : serverCookies) 
        {
        //System.out.println(cookie.split(";", 2)[0]); 
        genConnection.addRequestProperty("Cookie", cookie.split(";", 2)[0]);
        }  
        }
     }
   }
    
    public void uploadFile(String fileName, String url) throws  IOException//void returns nothing
    {
        File textFile = new File(fileName);
        CookieHandler.setDefault(new CookieManager(null, CookiePolicy.ACCEPT_ALL));
        setServerUrl(url);
        getUrlConnection(true);
        //genConnection.setDoOutput(true);
        genConnection.setRequestProperty("Content-Type", "multipart/form-data; boundary=" + boundary);
        if(serverCookies!=null)
        {
        setSeverCookies();
        }
   
        genOutput = genConnection.getOutputStream();
        genOutputStreamWriter = new OutputStreamWriter(genOutput, genCharset);
        try (PrintWriter writer = new PrintWriter(genOutputStreamWriter, true))
        {
        writer.append("--" + boundary).append(CRLF);
        String space=URLConnection.guessContentTypeFromName(textFile.getName());
        System.out.println(space);
        ////////////////////////////////////////////////////////
        writer.append("Content-Disposition: form-data; name=\"file\"; filename=\"" + textFile.getName() + "\"").append(CRLF);
        writer.append("Content-Type: " + URLConnection.guessContentTypeFromName(textFile.getName())).append(CRLF);
        //writer.append("Content-Type: text/plain; charset=" + charset).append(CRLF); // Text file itself must be saved in this charset!
        writer.append(CRLF).flush();
        Files.copy(textFile.toPath(), genOutput);
        genOutput.flush(); // Important before continuing with writer!
        writer.append(CRLF).flush(); // CRLF is important! It indicates end of boundary.
        ////////////////////////////////////////////////////////////
        //String qry="&strin=" + stringToReverse+"&number2=" + num2+"&file="+ pts.bi;
        //out.write(qry);
        //writer.append(qry);
        writer.append("--" + boundary + "--").append(CRLF).flush();
        } 
        as=genConnection.getHeaderFields();
        
        for(Entry <String,List<String>> t: genConnection.getHeaderFields().entrySet())
        { 
        
        //System.out.println(t.getKey() +" = "+t.getValue());
        //System.out.print(x); System.out.print(","); 
        }
         getSeverCookies();
        //getServercookies here usually located in the headers segment of the server response
        
        InputStream input = genConnection.getInputStream();
        BufferedReader in = new BufferedReader(new InputStreamReader(input));
        String decodedString;
        String decodedString2="";
        while ((decodedString = in.readLine()) != null) 
        {
            //System.out.println(decodedString);
            decodedString2+=decodedString;
         
        }
        //System.out.println(decodedString2);
        in.close();    
    }
    
    public void login(String LoginUrl,String Username,String Password) throws  IOException //void returns nothing
    {
        //CookieHandler.setDefault(new CookieManager(null, CookiePolicy.ACCEPT_ALL));
        setServerUrl(LoginUrl);
        getUrlConnection(true);
        genConnection.setRequestProperty("User-Agent", "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36"); // Do as if you're using Chrome 41 on Windows 7.
        genConnection.setRequestProperty("Content-Type","application/x-www-form-urlencoded");
        genConnection.setRequestProperty("Origin","https://uilugportal.unilorin.edu.ng");
       
       //setSeverCookies();
        
        genOutput = genConnection.getOutputStream();
        genOutputStreamWriter = new OutputStreamWriter(genOutput, genCharset);
        
        try (PrintWriter writer = new PrintWriter(genOutputStreamWriter, true))
        {
        //writer.append("--" + boundary).append(CRLF);
        //writer.append("Content-Type: text/plain; charset=" + genCharset).append(CRLF); 
        //writer.append(CRLF).flush();
        //genOutput.flush(); // Important before continuing with writer!
        //writer.append(CRLF).flush(); // CRLF is important! It indicates end of boundary.
        ////////////////////////////////////////////////////////////
       String qry="username=" + Username+"&password=" + Password;
     genOutputStreamWriter.write(qry);
     writer.append(qry);
     writer.append("--" + boundary + "--").append(CRLF).flush();
        }
        
        for(Entry <String,List<String>> t: genConnection.getHeaderFields().entrySet())
        { 
        
        System.out.println(t.getKey() +" = "+t.getValue());
        //System.out.print(x); System.out.print(","); 
        }
        getSeverCookies();
        InputStream input = genConnection.getInputStream();
        BufferedReader in = new BufferedReader(new InputStreamReader(input));
        String decodedString;
        String decodedString2="";
        PrintWriter fileOutputStream = new PrintWriter(new FileWriter("appDb/serverReply.html"));
        while ((decodedString = in.readLine()) != null) 
        {
        //System.out.println(decodedString);
        decodedString2+=decodedString; 
        System.out.println(decodedString+"\n");
        fileOutputStream.println(decodedString+"\n");
        }
        //System.out.println(decodedString2);
        jsonToStng(decodedString2);
//        for (String username1 : hashed_username) 
  //      {
    //    System.out.println(username1);
      //  }
        in.close(); 
        fileOutputStream.close();
    }
    
        public void jsonToStng(String json)
        {
         //System.out.println(json);
         String REGEX = "[{,}]";
         Pattern p =Pattern.compile(REGEX);
         Matcher m = p.matcher(json);
         String replace="";
         String remStr = m.replaceAll(replace);
         int a= 1;
         while(remStr.indexOf("*:*")!=-1)
         {
          String key=remStr.substring(0,remStr.indexOf("*:*"));
          remStr=remStr.replace(key,"");
          String value=remStr.substring(remStr.indexOf("*:*")+3,remStr.indexOf("*;*"));
          remStr=remStr.replace(value,"");
          remStr=remStr.replace("*:**;*","");
          //getRemVal(value+"%",a);
          getRemVal(value,a);
          a++;
         }       
        }
        
        
        public void getRemVal(String remStr,int incr)
        {
        if(incr==1)
        {
        username= remStr.split("%",delimiter);
        }
        else if(incr==2)
        {
  
        hashed_username=remStr.split("%",delimiter);
        }
        else if(incr==3)
        {
  
        fullname=remStr.split("%",delimiter);
        }
        else if(incr==4)
        {
        dp= remStr.split("%",delimiter);
        }
        else 
        { 
        sex= remStr.split("%",delimiter);
        }
      
        /*
        String REGEX = "[%]";
        String replace="";
        int i=0;
        while(remStr.indexOf("%")!=-1)
        {
        String key=remStr.substring(0,remStr.indexOf("%"));
        remStr=remStr.replace(key,"");
        remStr=remStr.replaceFirst(REGEX,replace);
        if(incr==1)
        {
        key=key.toLowerCase(); 
        username[i]= key;
        }
        else if(incr==2)
        {
        key=key.toUpperCase(); 
        fullname[i]= key;
        }
        else 
        {
        key=key.toLowerCase(); 
        dp[i]= key;
        //System.out.println( key);
        }
        i++;
        }
         */
        
        }
}
/*
public static void main(String[] args) throws Exception 
    {
String param = "value";
//File textFile = new File("HelloTrioOut.txz");
File binaryFile = new File("pic.jpg");
String boundary = Long.toHexString(System.currentTimeMillis()); // Just generate some unique random value.
String CRLF = "\r\n"; // Line separator required by multipart/form-data.
String charset = "UTF-8";
URL url =new URL("http://localhost/fitechbot/chat/NoteBook/testServerReply.php");

//URLConnection connection = new URL(url).openConnection();
URLConnection connection = url.openConnection();
connection.setDoOutput(true);
connection.setRequestProperty("Content-Type", "multipart/form-data; boundary=" + boundary);
///////////////////////////////////////////////////////////////////////
 String wrds="Hello World";
 String num="12345";
 String stringToReverse = URLEncoder.encode(wrds, "UTF-8");
 String num2 = URLEncoder.encode(num, "UTF-8");
 String qry="strin=" + stringToReverse+"&number2=" + num2;
   OutputStream output = connection.getOutputStream();
try (
   
    OutputStreamWriter out = new OutputStreamWriter(output, charset)
   
    
) {
    out.write(qry);
    PrintWriter writer = new PrintWriter(out, true);
    // Send normal param.
    writer.append("--" + boundary).append(CRLF);
    writer.append("Content-Disposition: form-data; name=\"param\"").append(CRLF);
    writer.append("Content-Type: text/plain; charset=" + charset).append(CRLF);
    writer.append(CRLF).append(param).append(CRLF).flush();
   //*/
    
    /* Send text file.
    writer.append("--" + boundary).append(CRLF);
    writer.append("Content-Disposition: form-data; name=\"textFile\"; filename=\"" + textFile.getName() + "\"").append(CRLF);
    writer.append("Content-Type: text/plain; charset=" + charset).append(CRLF); // Text file itself must be saved in this charset!
    writer.append(CRLF).flush();
    Files.copy(textFile.toPath(), output);
    output.flush(); // Important before continuing with writer!
    writer.append(CRLF).flush(); // CRLF is important! It indicates end of boundary.
    
    // Send binary file.
    writer.append("--" + boundary).append(CRLF);
    writer.append("Content-Disposition: form-data; name=\"binaryFile\"; filename=\"" + binaryFile.getName() + "\"").append(CRLF);
    writer.append("Content-Type: " + URLConnection.guessContentTypeFromName(binaryFile.getName())).append(CRLF);
    writer.append("Content-Transfer-Encoding: binary").append(CRLF);
    writer.append(CRLF).flush();
    Files.copy(binaryFile.toPath(), output);
    //Files.copy(source, target, REPLACE_EXISTING);
    output.flush(); // Important before continuing with writer!
    writer.append(CRLF).flush(); // CRLF is important! It indicates end of boundary.
     //
     //End of multipart/form-data.
    writer.append("--" + boundary + "--").append(CRLF).flush();
}
        try (BufferedReader in = new BufferedReader(
                new InputStreamReader(
                        connection.getInputStream()))) {
            String decodedString;
            while ((decodedString = in.readLine()) != null) {
                System.out.println(decodedString);
            }
        }
    }


}
*/