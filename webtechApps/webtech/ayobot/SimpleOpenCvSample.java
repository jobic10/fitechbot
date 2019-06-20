/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package ayobot;

/**
 *
 * @author CountryBoy
 */
import com.sun.jna.NativeLibrary;
import java.io.File;
import org.opencv.core.Core;  //core liibraries
import org.opencv.core.Mat;
import org.opencv.core.CvType;
import org.opencv.core.Scalar;
import uk.co.caprica.vlcj.runtime.RuntimeUtil;

class SimpleOpenCvSample {

  static{ System.loadLibrary(Core.NATIVE_LIBRARY_NAME); }

  public static void main(String[] args) 
  {
  
  //NativeLibrary.addSearchPath("libvlc","C:\\opencv_build\\lib");
  System.loadLibrary("libopencv_java342");
  Mat mat = Mat.eye(3, 3, CvType.CV_8UC1);
  System.out.println("mat = " + mat.dump());
    /**
    System.out.println("Welcome to OpenCV " + Core.VERSION);
    Mat m = new Mat(5, 10, CvType.CV_8UC1, new Scalar(0));
    System.out.println("OpenCV Mat: " + m);
    Mat mr1 = m.row(1);
    mr1.setTo(new Scalar(1));
    Mat mc5 = m.col(5);
    mc5.setTo(new Scalar(5));
    System.out.println("OpenCV Mat data:\n" + m.dump());
    *  */
  }

}