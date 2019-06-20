/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package ayobot;

import java.awt.event.WindowEvent;
import java.awt.event.WindowListener;

/**
 *
 * @author fitechbot
 */
public class MyWindowListener implements WindowListener
{

    @Override
    public void windowOpened(WindowEvent e) 
    {
    //System.out.println(e.getSource().toString());   
    }

    @Override
    public void windowClosing(WindowEvent e) 
    {
    System.exit(0); 
    }

    @Override
    public void windowClosed(WindowEvent e) 
    {
    //System.out.println(e.toString());
    }

    @Override
    public void windowIconified(WindowEvent e) 
    {
        
    }

    @Override
    public void windowDeiconified(WindowEvent e) 
    {
        
    }

    @Override
    public void windowActivated(WindowEvent e) 
    {
        
    }

    @Override
    public void windowDeactivated(WindowEvent e) 
    {
        
    }
  
    
}
