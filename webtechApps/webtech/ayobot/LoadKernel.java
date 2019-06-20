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

    import com.sun.jna.Library;
import com.sun.jna.Native;

/** Simple example of Windows native library declaration and usage. */
public class LoadKernel {
    public interface Kernel32 extends Library 
    {
        // FREQUENCY is expressed in hertz and ranges from 37 to 32767
        // DURATION is expressed in milliseconds
        public boolean Beep(int FREQUENCY, int DURATION);
        public void Sleep(int DURATION);
    }

    public static void main(String[] args) 
    {
	    Kernel32 lib = (Kernel32) Native.loadLibrary("kernel32", Kernel32.class);
            //User32 lib2 = (User32) Native.loadLibrary("User32", Kernel32.class);
           
	    lib.Beep(698, 500);
	    lib.Sleep(500);
	    lib.Beep(698, 500);
    }
}
