/*
 * AnimateButton.java
 *
 * Created on March 1, 2008, 1:15 AM
 */

package ayobot;

import java.awt.Cursor;
import java.awt.event.ActionListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import javax.swing.JButton;
import javax.swing.JComponent;
import javax.swing.Timer;

/**
 *
 * @author  P.Sakthivel
 */
public class AnimatedJButton extends JButton implements MouseListener , ActionListener
{
    public String text ;
    private int i = 0 ;
    private boolean status = true ;
    private Timer timer ;
    private int textGap_ ;
    private JComponent jcompo;
    /** Creates a new instance of AnimateButton */
    public AnimatedJButton( String text , int textGap )
    {
        super( text ) ;
        this.text = getText() ;
        addMouseListener( this ) ;
        textGap_ = textGap ;
        timer = new Timer( 100 , this ) ;
    }
    
    public void setLabelName( String text )
    {
        this.text = text ;
    }
    
    public static String getString( final String str , int gap )
    {
        StringBuffer buffer = new StringBuffer() ;
        
        int len = str.length() ;
        for( int i = 0 , j = 0 ; i <  len ; i++ )
        {
            buffer.insert( j++  , str.charAt( i ) ) ;
            if( i != len-1 )
            {
                for( int k = 0 ; k < gap ; k++)
                    buffer.insert( j++ , " " ) ;
            }
        }
        return buffer.toString() ;
    }
    
    public void mouseClicked(MouseEvent e)
    {
        
    }
    
    public void mouseEntered(MouseEvent e)
    {
        setCursor( Cursor.getPredefinedCursor( Cursor.HAND_CURSOR ) ) ;
        timer.start() ;
    }
    
    public void mouseExited(java.awt.event.MouseEvent e)
    {
        timer.stop() ;
        setCursor( Cursor.getPredefinedCursor( Cursor.DEFAULT_CURSOR ) ) ;
        setText( text ) ;
    }
    
    public void mousePressed(java.awt.event.MouseEvent e)
    {
    }
    
    public void mouseReleased(java.awt.event.MouseEvent e)
    {
    }
    
    public void actionPerformed(java.awt.event.ActionEvent e)
    {
       // System.out.println(e.getSource().toString());
        
        if( i <= textGap_ && status )
            setText( getString( text , i++ ) ) ;
        else
        {
            status = false ;
            setText( getString( text , i-- ) ) ;
            if( i == 0 )
            {
                status = true ;
            }
        }
    }
    
}
