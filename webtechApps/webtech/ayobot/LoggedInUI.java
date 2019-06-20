/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package ayobot;

import java.awt.BorderLayout;
import java.awt.Color;
import javax.swing.JComponent;
import javax.swing.JTextPane;

/**
 *
 * @author CountryBoy
 */
public class LoggedInUI extends javax.swing.JPanel 
{

    /**
     * Creates new form loggedInUI
     * @param uri
     */
    WebTechMainClass webTech2;
    public LoggedInUI(String uri,WebTechMainClass ins) 
    {   
         
        webTech2=ins;
        initComponents(uri);
        
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    public void initComponents(String uri) {
        WebTechMainClassActionListener actionLis=new WebTechMainClassActionListener(webTech2);
        buttonGroup1 = new javax.swing.ButtonGroup();
        jPanelMedia = new javax.swing.JPanel();
        mpics = new GetThumb(uri,300,300);
        jPanelTopControlsCont = new javax.swing.JPanel();
        //thumbnail = new javax.swing.JLabel();
        thumbnail =new GetThumb(uri,30,30);
        jLabelFullname = new javax.swing.JLabel();
        jLabelTime = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        jTextPanePost = new javax.swing.JTextPane();
        jPanel1 = new javax.swing.JPanel();
        jButtonEditPst = new javax.swing.JButton();
        jButtonEditPst.addActionListener(actionLis);
        jRadioButtonFollowersOnly = new javax.swing.JRadioButton();
        jRadioButtonFollowersOnly.setSelected(true);
        jButtonCmtPst = new javax.swing.JButton();
        jRadioButtonPublic = new javax.swing.JRadioButton();
        jButtonDelPst = new javax.swing.JButton();
        jButtonDelPst.addActionListener(actionLis);
        jRadioButtonOnlyMe = new javax.swing.JRadioButton();

        setBackground(new java.awt.Color(255, 255, 255));
        setBorder(javax.swing.BorderFactory.createEtchedBorder());
        setAutoscrolls(true);
        setPreferredSize(new java.awt.Dimension(440, 650));

        jPanelMedia.setToolTipText("panel for media i.e pix and videos");
        jPanelMedia.setPreferredSize(new java.awt.Dimension(100, 300));
        //jPanelMedia.setAlignmentX(CENTER_ALIGNMENT);
        //jPanelMedia.setAlignmentY(CENTER_ALIGNMENT);
         /*
        javax.swing.GroupLayout jPanelMediaLayout = new javax.swing.GroupLayout(jPanelMedia);
        jPanelMedia.setLayout(jPanelMediaLayout);
        jPanelMediaLayout.setHorizontalGroup(
            jPanelMediaLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
            .addGap(0, 0, Short.MAX_VALUE)
        );
        jPanelMediaLayout.setVerticalGroup(
            jPanelMediaLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
            .addGap(0, 77, Short.MAX_VALUE)
        );
        */
        //jPanelMedia.add(mpics).getAlignmentX();
        //System.out.println(jPanelMedia.getAlignmentX());
        jPanelMedia.add(mpics);
        jPanelMedia.add(new GetThumb(uri,300,300));
        jPanelTopControlsCont.setPreferredSize(new java.awt.Dimension(200, 52));

        jLabelFullname.setFont(new java.awt.Font("Arial", 1, 13)); // NOI18N
        jLabelFullname.setText("Super Administrator  Added A New Video");
        jLabelFullname.setAutoscrolls(true);
        jLabelFullname.setPreferredSize(new java.awt.Dimension(200, 15));

        jLabelTime.setBackground(new java.awt.Color(255, 255, 255));
        jLabelTime.setFont(new java.awt.Font("Arial", 0, 14)); // NOI18N
        jLabelTime.setForeground(new java.awt.Color(102, 102, 102));
        jLabelTime.setText(" 1 month 12 days 10 minutes ago on Sunday: 2018-09-16 ");
        jLabelTime.setAutoscrolls(true);
        jLabelTime.setPreferredSize(new java.awt.Dimension(200, 17));
        //thumbnail.setIcon(new javax.swing.ImageIcon("C:\\xampp\\htdocs\\fitechbot\\webtechApps\\webtech\\thumbnail.jpg"));
        javax.swing.GroupLayout jPanelTopControlsContLayout = new javax.swing.GroupLayout(jPanelTopControlsCont);
        jPanelTopControlsCont.setLayout(jPanelTopControlsContLayout);
        jPanelTopControlsContLayout.setHorizontalGroup(
            jPanelTopControlsContLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanelTopControlsContLayout.createSequentialGroup()
                .addContainerGap()
                .addComponent(thumbnail, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(jPanelTopControlsContLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jLabelFullname, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addComponent(jLabelTime, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                .addContainerGap())
        );
        jPanelTopControlsContLayout.setVerticalGroup(
            jPanelTopControlsContLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanelTopControlsContLayout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanelTopControlsContLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addComponent(jLabelTime, javax.swing.GroupLayout.PREFERRED_SIZE, 14, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addGroup(jPanelTopControlsContLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                        .addComponent(jLabelFullname, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addComponent(thumbnail, javax.swing.GroupLayout.Alignment.LEADING)))
                .addContainerGap())
        );

        jTextPanePost.setFont(new java.awt.Font("Arial", 0, 14)); // NOI18N
        jTextPanePost.setText("James_Gosling_2008\nJames Gosling initiated the Java language project in June 1991 for use in one of his many set-top box projects. The language, initially called Oak after an oak tree that stood outside Gosling's office, also went by the name Green and ended up later being renamed as Java, from a list of random words. Sun released the first public implementation as Java 1.0 in 1995. It promised Write Once, Run Anywhere (WORA), providing no-cost run-times on popular platforms. On 13 November 2006, Sun released much of Java as free and open source software under the terms of the GNU General Public License (GPL). On 8 May 2007, Sun finished the process, making all of Java's core code free and open-source, aside from a small portion of code to which Sun did not hold the copyright.");
        jScrollPane1.setViewportView(jTextPanePost);
        jTextPanePost.setEditable(false);
        jButtonEditPst.setText("edit");

        buttonGroup1.add(jRadioButtonFollowersOnly);
        jRadioButtonFollowersOnly.setText("followers only");
               
        jButtonCmtPst.setText("comment");

        buttonGroup1.add(jRadioButtonPublic);
        jRadioButtonPublic.setText("public");

        jButtonDelPst.setText("delete");

        buttonGroup1.add(jRadioButtonOnlyMe);
        jRadioButtonOnlyMe.setText("only me");
        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jButtonDelPst, javax.swing.GroupLayout.DEFAULT_SIZE, 98, Short.MAX_VALUE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jButtonEditPst, javax.swing.GroupLayout.DEFAULT_SIZE, 98, Short.MAX_VALUE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jButtonCmtPst, javax.swing.GroupLayout.DEFAULT_SIZE, 98, Short.MAX_VALUE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jRadioButtonOnlyMe, javax.swing.GroupLayout.DEFAULT_SIZE, 91, Short.MAX_VALUE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jRadioButtonFollowersOnly, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jRadioButtonPublic, javax.swing.GroupLayout.DEFAULT_SIZE, 91, Short.MAX_VALUE)
                .addContainerGap())
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jRadioButtonPublic)
                    .addComponent(jRadioButtonFollowersOnly)
                    .addComponent(jRadioButtonOnlyMe)
                    .addComponent(jButtonDelPst)
                    .addComponent(jButtonEditPst)
                    .addComponent(jButtonCmtPst))
                .addContainerGap())
        );

        jPanel1Layout.linkSize(javax.swing.SwingConstants.VERTICAL, new java.awt.Component[] {jRadioButtonOnlyMe, jRadioButtonFollowersOnly, jRadioButtonPublic});

        jPanel1Layout.linkSize(javax.swing.SwingConstants.VERTICAL, new java.awt.Component[] {jButtonDelPst, jButtonEditPst, jButtonCmtPst});

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 0, Short.MAX_VALUE)
                    .addComponent(jPanelMedia, javax.swing.GroupLayout.DEFAULT_SIZE, 597, Short.MAX_VALUE)
                    .addComponent(jPanelTopControlsCont, javax.swing.GroupLayout.DEFAULT_SIZE, 597, Short.MAX_VALUE)
                    .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                .addContainerGap())
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jPanelTopControlsCont, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 197, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jPanelMedia, javax.swing.GroupLayout.DEFAULT_SIZE, 77, Short.MAX_VALUE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jPanel1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(10, 10, 10))
        );
    }// </editor-fold>//GEN-END:initComponents


    // Variables declaration - do not modify//GEN-BEGIN:variables
    public javax.swing.ButtonGroup buttonGroup1;
    public javax.swing.JButton jButtonDelPst;
    public javax.swing.JButton jButtonEditPst;
    public javax.swing.JButton jButtonCmtPst;
    public javax.swing.JLabel jLabelFullname;
    public javax.swing.JLabel jLabelTime;
    public javax.swing.JPanel jPanel1;
    public javax.swing.JPanel jPanelMedia;
    public javax.swing.JComponent mpics;
    public javax.swing.JPanel jPanelTopControlsCont;
    public javax.swing.JRadioButton jRadioButtonOnlyMe;
    public javax.swing.JRadioButton jRadioButtonFollowersOnly;
    public javax.swing.JRadioButton jRadioButtonPublic;
    public javax.swing.JScrollPane jScrollPane1;
    public javax.swing.JTextPane jTextPanePost;
    //public javax.swing.JLabel thumbnail;
    public javax.swing.JComponent thumbnail;
    // End of variables declaration//GEN-END:variables
}
