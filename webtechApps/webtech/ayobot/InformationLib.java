/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package ayobot;

//package mrbool.vlc.example;


import uk.co.caprica.vlcj.binding.LibVlc;
import uk.co.caprica.vlcj.runtime.RuntimeUtil;
import uk.co.caprica.vlcj.runtime.x.LibXUtil;


import com.sun.jna.Native;
import com.sun.jna.NativeLibrary;


public class InformationLib {


    public static void main(String[] args) throws Exception 
    {
    	NativeLibrary.addSearchPath(
        RuntimeUtil.getLibVlcLibraryName(), "C:\\Program Files\\VideoLAN\\VLC");//d:/vlc-2.2.1"); libvlc
 
        Native.loadLibrary(RuntimeUtil.getLibVlcLibraryName(), LibVlc.class);
        LibXUtil.initialise();
    	//System.loadLibrary(Core.NATIVE_LIBRARY_NAME);
        System.out.println("  version: {}" + LibVlc.INSTANCE.libvlc_get_version()+LibVlc.class);
        System.out.println(" compiler: {}" + LibVlc.INSTANCE.libvlc_get_compiler());
        System.out.println("changeset: {}" + LibVlc.INSTANCE.libvlc_get_changeset());
    }
}