/*
 * $RCSfile: FreeVibration.java,v $
 *
 * Copyright (c) 2009 cITe, Inc. All rights reserved. *
 * $Revision: 1.3 $
 * $Date: 2009/07/21 $
 * $State: Exp $
 */


package cite.vlab.chemistry.demos;


import java.applet.Applet;
import java.applet.AudioClip;
import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Component;
import java.awt.Container;
import java.awt.Font;
import java.awt.GraphicsConfiguration;
import java.awt.GraphicsDevice;
import java.awt.GraphicsEnvironment;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.net.URL;
import java.util.HashMap;

import javax.media.j3d.AmbientLight;
import javax.media.j3d.Appearance;
import javax.media.j3d.BoundingSphere;
import javax.media.j3d.BranchGroup;
import javax.media.j3d.Canvas3D;
import javax.media.j3d.ColoringAttributes;
import javax.media.j3d.DirectionalLight;
import javax.media.j3d.Geometry;
import javax.media.j3d.GraphicsConfigTemplate3D;
import javax.media.j3d.Group;
import javax.media.j3d.LineArray;
import javax.media.j3d.LineAttributes;
import javax.media.j3d.Material;
import javax.media.j3d.PointArray;
import javax.media.j3d.PointAttributes;
import javax.media.j3d.Shape3D;
import javax.media.j3d.Switch;
import javax.media.j3d.Text3D;
import javax.media.j3d.Transform3D;
import javax.media.j3d.TransformGroup;
import javax.media.j3d.TriangleArray;
import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JApplet;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JPopupMenu;
import javax.swing.JSlider;
import javax.swing.Timer;
import javax.swing.WindowConstants;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
import javax.vecmath.Color3f;
import javax.vecmath.Point3d;
import javax.vecmath.Vector3d;
import javax.vecmath.Vector3f;

import cite.vlab.common.DataLogTable;
import cite.vlab.common.HorizontalGraph;
import cite.vlab.common.J3DShape;
import cite.vlab.common.PanelWindowWrapper;
import cite.vlab.common.PieChart;
import cite.vlab.common.Resources;

import com.sun.j3d.utils.geometry.Sphere;
import com.sun.j3d.utils.universe.PlatformGeometry;
import com.sun.j3d.utils.universe.SimpleUniverse;
import com.sun.j3d.utils.universe.ViewingPlatform;
/**
 * Simple Java 3D program that can be run as an application or as an applet.
 */
public class OpticalRotation extends javax.swing.JPanel {
	//  Variables declaration - do not modify//GEN-BEGIN:variables
	//////////////////////////GUI componenet ///////////////////////////
	private javax.swing.JPanel topPanel;
	private javax.swing.JPanel simulationPanel;
	private javax.swing.JPanel bottomPanel;
	private javax.swing.JPanel rightPanel;
	
	private javax.swing.JButton startButton=null;
	private javax.swing.JButton reStartButton=null;
	private javax.swing.JButton nextButton=null;
	private javax.swing.JButton mixButton=null;

	

	//private GraphPlotter         graphPlotter;
	////////////////////////////Java3D componenet ///////////////////////////

	private SimpleUniverse      univ = null;                  // Simple Universe Java3D
	private BranchGroup         scene = null;                 // BranchGroup Scene graph
	private Switch 				switchGroup=null;	
	private Switch 				switchGroup1=null;	//
	
	private RotationBody       freeBody =null;
	private PieChart           	arcs=null;
	private HorizontalGraph		outputGraph =null;
	private DataLogTable		m_table=null;

	private HashMap 			hm = new HashMap();
	private J3DShape 			m_j3d	= new J3DShape();
	
	private JSlider slider1;
	private JSlider slider2;
	private JLabel outlbl_val[];
	private JLabel iLabel[];
	private float fields[];
	private JLabel m_Objective= new JLabel("Objective:");
	

	private Timer timer=null; 
	// Timer for simulation    
	private float current_polorimeter_angle =0;  //this variable stores the information about current angle of polarimeter 
	private int table_row_count=0;
	private float adding_factor=0;
	private double timeperiod_1=0;
	private double timeperiod_2=0;
	private double length_1=0;
	private double length_2=0;
	
	
	

	private int stage = 0,counter=0;
	
	private boolean startStop = false;
	private boolean valChange = true;
	private boolean started=false;
	private boolean lines_1=true;
	private boolean lines_2=true;
	private boolean mixed=false;
	private boolean lid=false;
	URL url = Resources.getResource("resources/audio/magic_bells.wav");
    AudioClip  clip =  Applet.newAudioClip(url);;
	
	
	
	public BranchGroup createSceneGraph() 
	{
		// Create the root of the branch graph
		BranchGroup objRoot = new BranchGroup();
		objRoot.setCapability(Group.ALLOW_CHILDREN_EXTEND );
		objRoot.setCapability(Group.ALLOW_CHILDREN_READ);
		objRoot.setCapability(Group.ALLOW_CHILDREN_WRITE);
		objRoot.setCapability( BranchGroup.ALLOW_DETACH );
		
		
		
		// table 
		objRoot.addChild(m_j3d.createBox(new Vector3d(-0.0,-0.49, 0.2),new Vector3d(1,-.03,1),new Vector3d(0,0,0), new Color3f(1f, 1f, 1f),"resources/images/table.jpg"));
		objRoot.addChild(m_j3d.loadObjectFile("resources/geometry/table.obj",new Vector3d(-0.0,-.25, 0.8),new Vector3d(.59,.3,.7), new Vector3d(0,0,0),new Color3f(1, 0, 0)));
		
		//background
		objRoot.addChild(m_j3d.createBox(new Vector3d(0,0.4, -1),new Vector3d(1.7,1.5,.1),new Vector3d(0f, 0f,0f), new Color3f(.6f, .6f,.6f)));
		objRoot.addChild(createVirtualLab());
		//objRoot.addChild(m_j3d.createTextureBox("resources/images/table.jpg",new Vector3d(-0.0,-0.49, 0.2),new Vector3d(1,-.03,1),new Vector3d(0,0,0), new Color3f(.6f, .6f, .6f)));
		//objRoot.addChild(m_j3d.loadObjectFile("resources/geometry/table.obj",new Vector3d(-0.0,-.25, 0.8),new Vector3d(.55,.3,.7), new Vector3d(0,0,0),new Color3f(1, 0, 0)));
		//objRoot.addChild(m_j3d.createBox(new Vector3d(0,0.4, -1),new Vector3d(1.7,1.5,.1), new Color3f(.1f, .2f,.5f)));
		//objRoot.addChild(m_j3d.createTextureBox("resources/images/table.jpg",new Vector3d(0,-0.25, -.1),new Vector3d(1,.01,1),new Vector3d(0,0,0),new Color3f(0f, 1f, 0f)));
		
		
		
		Color3f light1Color = new Color3f(1f, 1f, 1f);
		
	    BoundingSphere bounds =  new BoundingSphere(new Point3d(0.0,0.0,0.0), 100.0);
	
	    Vector3f light1Direction = new Vector3f(4.0f, -7.0f, -12.0f);
	
	    DirectionalLight light1 = new DirectionalLight(light1Color, light1Direction);
	
	    light1.setInfluencingBounds(bounds);    
	    objRoot.addChild(light1);
	
	    AmbientLight ambientLight =  new AmbientLight(new Color3f(.5f,.5f,.5f));
	
	    ambientLight.setInfluencingBounds(bounds);
	
	    objRoot.addChild(ambientLight);
		return objRoot;
	}

    private Canvas3D createUniverse(Container container) {
        GraphicsDevice graphicsDevice;
        if (container.getGraphicsConfiguration() != null) {
            graphicsDevice = container.getGraphicsConfiguration().getDevice();
        } else {
            graphicsDevice =
                    GraphicsEnvironment.getLocalGraphicsEnvironment().getDefaultScreenDevice();
        }
        GraphicsConfigTemplate3D template = new GraphicsConfigTemplate3D();
        GraphicsConfiguration config = graphicsDevice.getBestConfiguration(template);

        Canvas3D c = new Canvas3D(config);

        univ = new SimpleUniverse(c);

        // This will move the ViewPlatform back a bit so the
        // objects in the scene can be viewed.
        
        ViewingPlatform viewingPlatform = univ.getViewingPlatform();
        univ.getViewingPlatform().setNominalViewingTransform();

        ViewingPlatform vp = univ.getViewingPlatform();
   	    TransformGroup steerTG = vp.getViewPlatformTransform();
   	    Transform3D t3d = new Transform3D();
   	    steerTG.getTransform(t3d);
   	    Vector3d s = new Vector3d();
   	    Vector3f currPos=new Vector3f();
   	    t3d.get(currPos); 
   	    
   	   // System.out.println("current Pos:" + currPos);
   	  
   	    
   	    t3d.lookAt( new Point3d(0, .2, 2.41 ), new Point3d(0,0,0), new Vector3d(0,1,0));
   	    t3d.invert();
   	    
   	    //t3d.setTranslation(new Vector3d(0,0,8));
   	    steerTG.setTransform(t3d);
   	    
       

        // Ensure at least 5 msec per frame (i.e., < 200Hz)
        univ.getViewer().getView().setMinimumFrameCycleTime(5);

        return c;
    }
    
    private void setLight() {
            BoundingSphere bounds = new BoundingSphere(new Point3d(0.0,0.0,0.0), 100.0);
            PlatformGeometry pg = new PlatformGeometry();


            Color3f ambientColor = new Color3f(0.1f, 0.1f, 0.1f);
            AmbientLight ambientLightNode = new AmbientLight(ambientColor);
            ambientLightNode.setInfluencingBounds(bounds);
            pg.addChild(ambientLightNode);


            Color3f light1Color = new Color3f(1.0f, 1.0f, 0.9f);
            Vector3f light1Direction  = new Vector3f(1.0f, 1.0f, 1.0f);
            Color3f light2Color = new Color3f(1.0f, 1.0f, 1.0f);
            Vector3f light2Direction  = new Vector3f(-1.0f, -1.0f, -1.0f);

            DirectionalLight light1
                    = new DirectionalLight(light1Color, light1Direction);
            light1.setInfluencingBounds(bounds);
            pg.addChild(light1);

            DirectionalLight light2
                    = new DirectionalLight(light2Color, light2Direction);
            light2.setInfluencingBounds(bounds);
            pg.addChild(light2);

            ViewingPlatform viewingPlatform = univ.getViewingPlatform();
            viewingPlatform.setPlatformGeometry( pg );


    }

    
    private void destroy() {
        univ.cleanup();
    }

        
   
    private Group createVirtualLab() {
 	      
	    Transform3D tr = new Transform3D();
	    float rad = (float)Math.PI/180;
        tr.rotY(rad*25);//tr.rotY(rad*30);
        //tr.setTranslation(new Vector3f(-0.36f,0.02f,0.1f));
        tr.setTranslation(new Vector3f(-0.25f,0.02f,0.1f));
		                    
	    TransformGroup objtrans = new TransformGroup(tr);
	    objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE);
	    objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_READ);
	    
	    // BULB
	    objtrans.addChild(m_j3d.loadObjectFile("resources/geometry/Blub.obj",new Vector3d(-0.63f,-0.09f,0.75),new Vector3d(.09,.045,.07), new Vector3d(0,0,0),new Color3f(1, 1, 1)));
	    //line coming from bulb
	    //objtrans.addChild(m_j3d.createLine(new Point3d(-0.62f,-0.06f,0.8), new Point3d(0,-0.06f,0.8),new Vector3d(0,0,0),new Vector3d(1,1,1), new Color3f(1.0f,1,0)));
	    // cmt line
	    
       //objtrans.addChild(m_j3d.loadObjectFile("resources/geometry/verreEau.obj",new Vector3d(0.0f,.3f,1f),new Vector3d(0.4,.4,0.4),new Vector3d(0,0,0), new Color3f(1, 0, 0)));
	   // objtrans.addChild(m_j3d.createCylinder(new Vector3d(0,-0.06f,0.8), new Vector3d(0.9,5,1),new Vector3d(0,0,90), new Color3f(0.0f/255.0f,122.0f/255.0f,245.0f/255.0f)));
	   //start 
	   //objtrans.addChild(createDiskWithLines(new Vector3d(-0.6f,-0.06f,0.8),new Vector3d(1,1,1),new Vector3d(0,0,0),35,0.1f,new Color3f(1,0,0)));
	   //objtrans.addChild(createArrowsOnLine(new Vector3d(-0.6f,-0.06f,0.8),new Vector3d(1,1,1),new Vector3d(0,0,0),30,0.1f,new Color3f(1,1,0)));
	    
	   //cylinder at the center verical one 
	   objtrans.addChild(m_j3d.createCylinderWithMatProp(new Vector3d(0,-0.02f,0.8), new Vector3d(0.4,1.2,0.68),new Vector3d(0,0,0), m_j3d.getColor3f(0,122,245),m_j3d.getColor3f(235,239,245),new Color3f(0.1f,0.1f,0.1f),new Color3f(0.6f,0.5f,0.0f),new Color3f(0.3f,0.3f,0.3f),70.0f));
	    
	  // objtrans.addChrrild(m_j3d.createCylinderWithMatProp(new Vector3d(0,0.05f,0.8), new Vector3d(0.6,0.16,1),new Vector3d(0,0,0), m_j3d.getColor3f(0,122,245),new Color3f(0.6f,0.5f,0.0f),new Color3f(0.1f,0.1f,0.1f),new Color3f(0.6f,0.5f,0.0f),new Color3f(0.3f,0.3f,0.3f),70.0f));
	    
	   //objtrans.addChild(m_j3d.createCylinder(new Vector3d(-0.54f,-0.06f,0.8), new Vector3d(0.65,0.09,1),new Vector3d(0,0,90), m_j3d.getColor3f(228,102,231)));
	   //left polariser which is looking like mirror
	   objtrans.addChild(m_j3d.loadObjectFile("resources/geometry/ovalMirror.obj",new Vector3d(-0.54f,-0.06f,0.8),new Vector3d(.1,.08,.1), new Vector3d(0,-80,0),new Color3f(1, 0, 0)));
	   timeperiod_1=0.07;
	   length_1=0.001;  //intially sinwave should not appear so length is negligibile
	   objtrans.addChild(createlineSinwave(new Vector3d(-0.53f,-0.06f,0.8) ,new Vector3d(0.84,0.05,1),new Vector3d(0,0,0),timeperiod_1,length_1,new Color3f(0.8f,0.8f,0.0f),"sin1",lines_1,new Color3f(0.8f,0.8f,0.0f),hm));
	   //Horizontal big long cylinder
	   objtrans.addChild(m_j3d.createCylinderWithMatProp(new Vector3d(0,-0.06f,0.8), new Vector3d(0.7,5,1),new Vector3d(0,0,90), m_j3d.getColor3f(0,122,245),new Color3f(0.1f,0.1f,0.2f),new Color3f(0.3f,0.4f,0.5f),new Color3f(0.4f,0.5f,0.4f),new Color3f(0.3f,0.3f,0.3f),70.0f));
	   
	   //objtrans.addChild(m_j3d.createCylinder(new Vector3d(0.54f,-0.05f,0.8), new Vector3d(0.95,0.09,1),new Vector3d(0,0,90), m_j3d.getColor3f(228,102,231)));
	   
	  objtrans.addChild(m_j3d.loadObjectFile("resources/geometry/ovalMirror.obj",new Vector3d(0.54f,-0.06f,0.78),new Vector3d(.14,.08,.1), new Vector3d(0,-80,0),new Color3f(1, 0, 0)));
	   
	   //This right slit looking like mirror to rotate it i have taken transformGroup separatly and then in timer function i am updating it 
        Transform3D tr4=new Transform3D();
	   tr4.setTranslation(new Vector3d(0.529,-0.06,0.8-0.02));
	   TransformGroup line = new TransformGroup(tr4);
	   
	   hm.put("line",line); // to retrive this later 
	   objtrans.addChild(line);
	   line.addChild(m_j3d.createLine(new Point3d(0 ,-0.05,0),new Point3d(0,0.01+0.04,0),new Vector3d(0,0,0),new Vector3d(1,1.6,1),new Color3f(0.0f,0.0f,0.0f)));
	  line.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE);
	  line.setCapability(TransformGroup.ALLOW_TRANSFORM_READ); 
	   
	  
	  //This transformGroup is for polarimeter at the right last
	   Transform3D tr3 = new Transform3D();
	   tr3.setTranslation(new Vector3d(.65,-0.07f,0.726));
	   TransformGroup polarimeter = new TransformGroup(tr3);
	   polarimeter.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE);
	   polarimeter.setCapability(TransformGroup.ALLOW_TRANSFORM_READ);
	   polarimeter.addChild(m_j3d.createCylinderWithMatProp(new Vector3d(0,0,0), new Vector3d(0.7,.7,.7),new Vector3d(0,0,95), m_j3d.getColor3f(130,130,130),new Color3f(.1f,.1f,.1f),new Color3f(0.4f,0.4f,0.4f),new Color3f(0.5f,0.5f,0.5f),new Color3f(0.3f,0.3f,0.3f),30.0f));
	  // polarimeter.addChild(m_j3d.loadObjectFile("resources/geometry/ovalMirror.obj",new Vector3d(-0.11f,0.01f,0.055),new Vector3d(.14,.08,.1), new Vector3d(0,-80,0),new Color3f(1, 0, 0)));
	   hm.put("polarimeter",polarimeter);
	   
	   
	   
	   objtrans.addChild(polarimeter);
	   
	   ///65
	   //objtrans.addChild(m_j3d.createLine(new Point3d(0.26f,-0.06f,0.8), new Point3d(0.78,-0.06f,0.8),new Vector3d(0,0,0),new Vector3d(1,1,1), new Color3f(0.9f,0.9f,0.0f)));
	   // cmt line
	   //objtrans.addChild(m_j3d.createCylinder(new Vector3d(-0.25f,-0.06f,0.8), new Vector3d(0.6,0.07,1),new Vector3d(0,0,90), m_j3d.getColor3f(92, 172, 238 )));
	   //objtrans.addChild(m_j3d.createCylinder(new Vector3d(0.25f,0.06f,0.8), new Vector3d(0.65,0.09,1),new Vector3d(0,0,90), m_j3d.getColor3f(228,102,231)));
	   
      // objtrans.addChild(createArrowsOnLine(new Vector3d(-0.6f,-0.06f,0.8),new Vector3d(1,1,1),new Vector3d(0,0,0),30,0.1f,new Color3f(1,0,0)));
	   
	   //this transform group is for rotating sinwave at the right side
	   Transform3D t = new Transform3D();
	   t.setTranslation(new Vector3f(0.265f,-0.06f,0.8f));
	   TransformGroup rotated_sinwave = new TransformGroup(t);
	   rotated_sinwave.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE); 
	   rotated_sinwave.setCapability(TransformGroup.ALLOW_TRANSFORM_READ);
	  // objtrans.addChild(createsinWave(new Vector3d(-0.53f,-0.06f,0.8) ,new Vector3d(0.84,0.05,1),new Vector3d(0,0,0),timeperiod_1,length_1,m_j3d.getColor3f(4,60,66),"sin1","line1",hm));
	   timeperiod_2=0.1;
	   length_2=0.001;
	   rotated_sinwave.addChild(createlineSinwave(new Vector3d(0,0,0) ,new Vector3d(0.9,0.05,1),new Vector3d(0,0,0) ,timeperiod_2,length_2,new Color3f(0.8f,0.8f,0.0f),"sin2",lines_2,new Color3f(0.8f,0.8f,0.0f),hm));
	   //rotating line 
	   //rotated_sinwave.addChild(m_j3d.createLine(new Point3d(0.27,0,0),new Point3d(0.27,0.05,0),new Vector3d(0,0,0),new Vector3d(1,1.6,1),new Color3f(0,0,0)));
	   objtrans.addChild(rotated_sinwave);
	  //static vertical line polarizer
	   
	  // objtrans.addChild(m_j3d.createLine(new Point3d(0.535,-0.09,0.8),new Point3d(0.535,0.01,0.8),new Vector3d(0,0,0),new Vector3d(1,1.6,1),new Color3f(0.0f,0.0f,0.0f)));
	   //arrow for line coming from bulb
	   //objtrans.addChild(createTriangle(new Point3d(-0.54,-0.06f,0.8),new Point3d(-0.55,-0.05,0.8),new Point3d(-0.55,-0.07,0.8),new Vector3d(1,1,1),new Vector3d(0,0,0),new Color3f(1.0f,0f,0f)));
	   //triangle at the end 
	   //objtrans.addChild(createTriangle(new Point3d(0.78,-0.06f,0.8),new Point3d(0.765,-0.045,0.8),new Point3d(0.765,-0.075,0.8),new Vector3d(1,1,1),new Vector3d(0,0,0),new Color3f(1.0f,0f,0f)));
	   
	   
//	   	Appearance ap = new Appearance ();
//	    ap.setCapability(Appearance.ALLOW_COLORING_ATTRIBUTES_WRITE); 
//	    ColoringAttributes ca =new ColoringAttributes();
//	    ca.setCapability(ColoringAttributes.ALLOW_COLOR_WRITE);			    
//	    ca.setCapability(ColoringAttributes.ALLOW_COLOR_READ);
//	    ca.setColor(new Color3f(0.501f,0.501f,0.501f));
//	    ap.setColoringAttributes(ca);
//	    
//	    TransparencyAttributes ta = new TransparencyAttributes();
//	    ta.setTransparencyMode (TransparencyAttributes.FASTEST);
//	    ta.setTransparency (0.3f);
//	    ap.setTransparencyAttributes (ta);
//	        
//		
//	    tr = new Transform3D();
//	    TransformGroup tg = new TransformGroup();
//	    tr.rotZ(Math.toRadians(90));
//	    tr.setTranslation(new Vector3d(0,-0.06f,0.8));
//	    tr.setScale(new Vector3d(1,2.1,1.2));
//	    tg.setTransform(tr);
//	       
//	    tg.addChild(new Cylinder(0.09f,0.5f,ap));
//	    	    
//	    objtrans.addChild(tg);
	   // these 4 making arrow pointing polarizer to right side polarimeter view
	   objtrans.addChild(m_j3d.createLine(new Point3d(0.665,-0.02,0.8),new Point3d(0.73,-.02,0.8),new Vector3d(0,0,0),new Vector3d(1,1,1),m_j3d.getColor3f(255,0,0)));
	   objtrans.addChild(m_j3d.createLine(new Point3d(0.73,-0.02,0.8),new Point3d(0.73,-.06,0.8),new Vector3d(0,0,0),new Vector3d(1,1,1),m_j3d.getColor3f(255,0,0)));
	   objtrans.addChild(m_j3d.createLine(new Point3d(0.73,-0.06,0.8),new Point3d(0.78,-.06,0.8),new Vector3d(0,0,0),new Vector3d(1,1,1),m_j3d.getColor3f(255,0,0)));
	   objtrans.addChild(createTriangle(new Point3d(0.78,-0.06f,0.8),new Point3d(0.765,-0.045,0.8),new Point3d(0.765,-0.075,0.8),new Vector3d(1,1,1),new Vector3d(0,0,0),new Color3f(1.0f,0f,0f)));
	   //objtrans.addC\
	   Drop oil[]=new Drop[10];
	   for(int i=0;i<10;i++)
  	   {
	        Appearance ap =new Appearance();
		    ColoringAttributes ca = new ColoringAttributes();
		    ca.setColor(m_j3d.getColor3f(202, 225, 255));
		    ap.setColoringAttributes(ca);
		    //ap.setMaterial(new Material(m_j3d.getColor3f(202, 225, 255),new Color3f(0.0f,0.0f,0.0f),new Color3f(0.6f,0.5f,0.0f),new Color3f(1.0f,1.0f,1.0f),70.f));
		    
		    Sphere sphere = new Sphere(0.06f,ap);
		    Transform3D trr = new Transform3D();
	 	    TransformGroup tg = new TransformGroup();
	 	    tg.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE);
	 	    tg.setCapability(TransformGroup.ALLOW_TRANSFORM_READ);
	 	    trr.setScale(new Vector3d(.2,.2,.2));
	 	    trr.setTranslation(new Vector3d(-0.1,0.3,0.0));
	 	    tg.setTransform(trr);
	 	    tg.addChild(sphere);
		    
	 	   objtrans.addChild(tg);
	 	  // Drop oil[]=new Drop[10];
	 	  
	        oil[i]= new Drop(new Vector3d(0,2.3,0.0),new Vector3d(0,-1,0) ,new Vector3d(.2,.2,.2), tg , 
	        		new Vector3d(-0.2,-0.6,0.0) ,new Vector3d(0.2,0.4,.0));     
	        oil[i].setPosition(new Vector3d(4,2.3,0.0));
	        hm.put("oil"+(i+1),oil[i]);
 	   }
	   
	   freeBody = new RotationBody(new Vector3d(0.265f,-0.06f,0.8f),rotated_sinwave);
	   started=true;
	   //in this switch group 
	   switchGroup = new Switch( Switch.CHILD_MASK );
	   switchGroup.setCapability( Switch.ALLOW_SWITCH_WRITE );
	   //this line coming from blub
	   switchGroup.addChild(m_j3d.createLine(new Point3d(-0.62f,-0.06f,0.8), new Point3d(-0.55,-0.06f,0.8),new Vector3d(0,0,0),new Vector3d(1,1,1), new Color3f(1.0f,1,0)));
	   //Arrow at the end of line coming form  bulb
	   switchGroup.addChild(createTriangle(new Point3d(-0.54,-0.06f,0.8),new Point3d(-0.55,-0.05,0.8),new Point3d(-0.55,-0.07,0.8),new Vector3d(1,1,1),new Vector3d(0,0,0),new Color3f(1.0f,0f,0f)));
	   //switchGroup.addChild()
	   //switchGroup.addChild(m_j3d.createCylinderWithMatProp(new Vector3d(-0.631,-0.071f,0.76), new Vector3d(0.12,0.19,0.2),new Vector3d(0,0,0), m_j3d.getColor3f(0,122,245),m_j3d.getColor3f(235,239,245),new Color3f(0.1f,0.1f,0.1f),new Color3f(0.6f,0.5f,0.0f),new Color3f(0.3f,0.3f,0.3f),70.0f));
	    
	  //switchGroup.addChild(creaeSphere(new Vector3d(-0.631,-0.0665f,0.76) ,0.02f, m_j3d.getColor3f(0,147,147),m_j3d.getColor3f(0,147,147),new Color3f(0,0,0) ,new Color3f(0,0,0) ,20.0f));
	  //Sphere  with yellow color and very bright , used to show bulb is on 
	  switchGroup.addChild(createSphere(new Vector3d(-0.631,-0.0665f,0.75) ,0.021f, new Color3f(1.0f,1.0f,0),new Color3f(1.0f,1.0f,0),new Color3f(1,1,1) ,new Color3f(0,0,0) ,30.0f));
	  //Sphere with yellow color and dull , used to show bulb is off
	  switchGroup.addChild(createSphere(new Vector3d(-0.631,-0.0665f,0.75) ,0.021f, m_j3d.getColor3f(200,200,0),m_j3d.getColor3f(200,200,0),new Color3f(0,0,0) ,new Color3f(0,0,0) ,2.0f));
	  //This is lid on the center cylinder , when solution is coming from top this should not appear
	  
	  switchGroup.addChild(m_j3d.createCylinderWithMatProp(new Vector3d(0,0.05f,0.8), new Vector3d(0.6,0.16,1),new Vector3d(0,0,0), m_j3d.getColor3f(0,122,245),new Color3f(0.6f,0.5f,0.0f),new Color3f(0.1f,0.1f,0.1f),new Color3f(0.6f,0.5f,0.0f),new Color3f(0.3f,0.3f,0.3f),70.0f));
	   
	   java.util.BitSet visibleNodes = new java.util.BitSet( switchGroup.numChildren() );
	   visibleNodes.set( 3); // intially the bulb is off
	   visibleNodes.set(4); //intially lid is there 
	   switchGroup.setChildMask( visibleNodes );
	   
	   
	   objtrans.addChild(switchGroup);
	   
	   switchGroup1 = new Switch( Switch.CHILD_MASK );
	   switchGroup1.setCapability( Switch.ALLOW_SWITCH_WRITE );
	   Transform3D tr6=new Transform3D();
	   tr6.rotX(rad*-110);
	   tr6.setTranslation(new Vector3f(0.1f,0.2f,0.75f));
	   TransformGroup glass= new TransformGroup(tr6);
	   glass.addChild(m_j3d.loadObjectFile("resources/geometry/vase1.obj",new Vector3d(-0.05,0,0),new Vector3d(.05,.05,.05), new Vector3d(0,0,0),new Color3f(1, 1, 1)));
	   switchGroup1.addChild(glass);
	   /*java.util.BitSet visibleNodes1 = new java.util.BitSet( switchGroup.numChildren() );
	   visibleNodes1.set(0);
	   visibleNodes1.set(1);
	   switchGroup1.setChildMask( visibleNodes1 ); */
	   objtrans.addChild(switchGroup1);
	   
	   return objtrans;
	   
	}
    
     
     
     
     
    
    /**
     * Creates new form FreeVibration
     */
    public OpticalRotation(Container container) {
        // Initialize the GUI components
        JPopupMenu.setDefaultLightWeightPopupEnabled(false);
        initComponents();

        centerPanel(container);
//        scene.addChild(bgleg);
    }

    
    // ----------------------------------------------------------------
    
    // Applet framework

    public static class MyApplet extends JApplet {
        OpticalRotation mainPanel;

        public void init() {
            setLayout(new BorderLayout());
            mainPanel = new OpticalRotation(this);
            add(mainPanel, BorderLayout.CENTER);
                        
        }

        public void destroy() {
            mainPanel.destroy();
        }
    }

    // Application framework

    private static class MyFrame extends JFrame {
        MyFrame() {
            setLayout(new BorderLayout());
            setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
            setTitle("Optical Rotation Applet");
            getContentPane().add(new OpticalRotation(this), BorderLayout.CENTER);
            pack();
        }
    }

    // Create a form with the specified labels, tooltips, and sizes.
    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new MyFrame().setVisible(true);
            }
        });
    }
    
    /** This method is called from within the constructor to
     * initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is
     * always regenerated by the Form Editor.
     */
    // <editor-fold defaultstate="collapsed" desc=" Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {
        
        
//      new GridLayout(2, 1)
        setLayout(new java.awt.BorderLayout());
        
        bottomPanel = new javax.swing.JPanel(); 	// input from user at bottom
        simulationPanel = new javax.swing.JPanel(); // 3D rendering at center
        topPanel= new javax.swing.JPanel();    		// Pause, resume, Next
        rightPanel = new javax.swing.JPanel();    	// Graph and Input and Output Parameter
                
         
        topPanel();
        bottomPanel();
        rightPanel();
        
//      Set Alignment
        //add(guiPanel, java.awt.BorderLayout.NORTH);
        add(topPanel, java.awt.BorderLayout.NORTH);
        add(simulationPanel, java.awt.BorderLayout.CENTER);
        add(bottomPanel, java.awt.BorderLayout.SOUTH);
        add(rightPanel, java.awt.BorderLayout.EAST); 
        
        startStop = false;
    	valChange = true;
    	stage =0;
        
        timer = new Timer(200,new ActionListener() {
            public void actionPerformed(ActionEvent evt) {
                //...Perform a task...
            	timerActionPerformed(evt);
            }
        });
        
                            

        
    }// </editor-fold>//GEN-END:initComponents

    private void topPanel() {
            
        java.awt.GridBagConstraints gridBagConstraints;
            
        javax.swing.JPanel guiPanel = new javax.swing.JPanel(); // Pause, resume at top
        guiPanel.setLayout(new java.awt.GridBagLayout());
        gridBagConstraints = new java.awt.GridBagConstraints();
        gridBagConstraints.insets = new java.awt.Insets(4, 4, 4, 4);  
                
//        javax.swing.JButton pauseButton = new javax.swing.JButton();  
//        javax.swing.JButton startButton = new javax.swing.JButton(); 
        reStartButton = new javax.swing.JButton("Re-Start");
        ImageIcon icon = m_j3d.createImageIcon("resources/icons/restart.png"); 
        reStartButton.setIcon(icon);
        startButton = new javax.swing.JButton("Start");
        icon = m_j3d.createImageIcon("resources/icons/start.png"); 
        startButton.setIcon(icon);
        nextButton = new javax.swing.JButton("Next");
//        icon = m_j3d.createImageIcon("resources/icons/next.png");        
//        nextButton.setIcon(icon);
             
        reStartButton.setEnabled(false);       
        nextButton.setEnabled(false);
        
        guiPanel.add(reStartButton, gridBagConstraints);
        guiPanel.add(startButton, gridBagConstraints);
        //guiPanel.add(nextButton, gridBagConstraints);
        
        guiPanel.setBackground(new Color(241,241,235));
        
        topPanel.setLayout(new java.awt.BorderLayout());
        topPanel.add(guiPanel, java.awt.BorderLayout.NORTH);
        
        
        startButton.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
            	// Toggle
            	startStop = !startStop;
            	
            	if(startStop)  startSimulation(evt); 
            	else pauseSimulation();
            }
          });
        
       
        
        reStartButton.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
            	
            	timer.stop();            	
            	reStartButton.setEnabled(false);
                //startButton.setEnabled(true);
                startButton.setText("Start");
                startStop = !startStop;
                
                outputGraph.clearGraphValue();
                outputGraph.drawGraph();
                m_table.clearAllData();
                //inputGraph.clearGraphValue();
                
                valChange = true;
                startSimulation(evt);
                
                
            }
          });
        
       

    }
    
    
    private void rightPanel() {
        
    	outlbl_val = new JLabel[5];
    	
    	rightPanel.setLayout(new java.awt.GridLayout(3,1,0,10));
    	rightPanel.setBorder(BorderFactory.createLineBorder(new Color(67,143,205),8));
    	
        //javax.swing.JPanel guiPanel = new javax.swing.JPanel(); // Pause, resume at top
        //guiPanel.setLayout(new java.awt.GridBagLayout());
        //gridBagConstraints = new java.awt.GridBagConstraints();
        //gridBagConstraints.insets = new java.awt.Insets(0, 0, 0, 0);  
        
    	
        
        /*inputGraph = new HorizontalGraph(300,160,"","");
        inputGraph.setHeading("");
        inputGraph.setAxisUnit(""," ");
        inputGraph.setYAxisColor(Color.GREEN);        
        inputGraph.fitToYwindow(false);
        rightPanel.add(inputGraph);*/
//        outputGraph1 = new HorizontalGraph(300,180,"TIME","CONCENTRATION"); 
//        outputGraph1.setHeading(" Concentration Vs Time");
//        outputGraph1.setAxisUnit(" sec"," M");
//        outputGraph1.setYAxisColor(new Color(0.0f,0.54f,0.27f));
//        outputGraph1.setYScale(8);
//        outputGraph1.fitToYwindow(false);
        //HorizontalGraphWrapper gwrapper = new HorizontalGraphWrapper(outputGraph,1,2,Color.GRAY);
        
        outputGraph = new HorizontalGraph(300,190,"t","alpha"); 
        outputGraph.setHeading("ROTATION (alpha) Vs Time");
        outputGraph.setAxisUnit("min","deg");
        outputGraph.setYAxisColor(Color.BLUE);
        outputGraph.setYScale(1);
        outputGraph.fitToYwindow(true);
        
        rightPanel.add(outputGraph);
               
        arcs = new PieChart (300,130,40,1);
        arcs.setm_bkg_Color(new Color(200,200,200));
       // arcs.setLineflag(); // to draw line to show angle 
        arcs.setHeading("Polarimeter View");
        arcs.addArc("arc1",90,180,Color.BLUE);
        arcs.addArc("arc2",270,180,Color.yellow);
        
        //rightPanel.add(arcs);
        JPanel  p[]= new JPanel[3];
        p[0] = new JPanel(new java.awt.GridBagLayout());;
        p[1] = arcs;
        p[2] = new JPanel(new java.awt.GridBagLayout());
        
        JLabel lbl = new JLabel("Analyser", JLabel.CENTER);
	    //lbl.setForeground(Color.white); 
	    java.awt.GridBagConstraints gridBagConstraints;
	    gridBagConstraints = new java.awt.GridBagConstraints();
        gridBagConstraints.insets = new java.awt.Insets(4, 0, 4, 0);
	    p[2].add(lbl,gridBagConstraints);   
	    
	    int min=-20;
	    int max=90;
	  
	    slider2 = new JSlider(JSlider.HORIZONTAL, min, max, 0);
	    slider2.addChangeListener(new ChangeListener() {
		    public void stateChanged(ChangeEvent e) {
		    	valChange = true;
		    	int val =((JSlider) e.getSource()).getValue();
		    	fields[1]=val;
		    	//outlbl_val[2].setText(":: " + val); 
		    	iLabel[1].setText(":" + val + " deg"); 
		    	//iLabel[1].setText("-");
		    	float  rotation = (float)freeBody.getRotation();
		    	if(counter< 60)
		    		rotation=0;
		    	float time=(float)freeBody.getTime();
		    	float diff =val-rotation;
		    	
		    	if(diff<1 && diff >=0)
		    	{   table_row_count+=1;
		    		m_table.addDopleMomentData(new Object[]{
		    				String.valueOf((float)time),String.valueOf((float)rotation)});
		    		clip.play(); 
		    	}
		    	
		    	
		    }
		 });
	    //slider2.setPreferredSize(new Dimension(150,20));
	    //slider2.setBackground(Color.black);
	    p[2].add(slider2,gridBagConstraints);
	    p[2].add(iLabel[1],gridBagConstraints); 
        
	    gridBagConstraints = new java.awt.GridBagConstraints();
        gridBagConstraints.insets = new java.awt.Insets(4, 0, 4, 0);
        lbl = new JLabel("Clock: ", JLabel.CENTER);
    	ImageIcon icon = m_j3d.createImageIcon("resources/icons/Alarm.png"); 
    	lbl.setIcon(icon);
    	lbl.setFont(new Font("Arial", Font.BOLD, 18));
    	p[0].add(lbl,gridBagConstraints);	
    	p[0].setBackground(new Color(219,226,238));
    	outlbl_val[3] = new JLabel(" t min", JLabel.LEFT);
    	outlbl_val[3].setFont(new Font("Arial", Font.BOLD, 18));
       	outlbl_val[3].setForeground( new Color(0,100,0)); 
    	p[0].add(outlbl_val[3],gridBagConstraints);
	     
	    
        PanelWindowWrapper win = new PanelWindowWrapper(p,new Color(200,200,200));
        rightPanel.add(win);
                        
        String[] columnNames = {"Time(min)",  "Rotation(deg)"};
        m_table = new DataLogTable(columnNames,300, 50);
        rightPanel.add(m_table);
        
        
//        gwrapper = new HorizontalGraphWrapper(inputGraph,1,2);
//        rightPanel.add(gwrapper);
        // Can't call draw graph here as Graphics object is not initialize
                
        //guiPanel.add(outputGraph);
        
        //rightPanel.setLayout(new java.awt.BorderLayout());
        //GridLayout(int rows, int cols, int hgap, int vgap) 
        
        
        //rightPanel.add(inputGraph);
        //rightPanel.setSize(300,500);
        //rightPanel.setMaximumSize(new Dimension(300,500));
        
        //rightPanel.setVisible(false);
        
        
        //rightPanel.setBackground(new Color(0,0,0));
       enable(0);
    }
    
    
    private void centerPanel(Container container){
    	
   	 	simulationPanel.setPreferredSize(new java.awt.Dimension(1000, 460));
        simulationPanel.setLayout(new java.awt.BorderLayout());
       
        javax.swing.JPanel guiPanel = new javax.swing.JPanel();
        guiPanel.setBackground(new Color(100,100,100));
        JLabel lbl = new JLabel("Inversion of Cane Sugar ", JLabel.CENTER);
        lbl.setFont(new Font("Arial", Font.BOLD, 18));

        lbl.setForeground(Color.orange);
        //lbl.setBackground(Color.BLACK);
        guiPanel.add(lbl);
        simulationPanel.add(guiPanel, BorderLayout.NORTH);
        
        Canvas3D c = createUniverse(container);
        simulationPanel.add(c, BorderLayout.CENTER);

        JPanel btmPanel = new javax.swing.JPanel(new java.awt.BorderLayout());
        simulationPanel.add(btmPanel, BorderLayout.SOUTH);
        
        guiPanel = new javax.swing.JPanel();
        guiPanel.setBackground(new Color(100,100,100));         
        simulationPanel.add(guiPanel, BorderLayout.EAST);
        
        guiPanel = new javax.swing.JPanel();
        guiPanel.setBackground(new Color(100,100,100));         
        simulationPanel.add(guiPanel, BorderLayout.WEST);
        
        // Create the content branch and add it to the universe
        scene = createSceneGraph();
        univ.addBranchGraph(scene);
     
        
        m_Objective = new JLabel(">: Start the experiment.", JLabel.LEFT);
        m_Objective.setFont(new Font("Arial", Font.BOLD, 13));
        m_Objective.setForeground(Color.WHITE);
        guiPanel = new javax.swing.JPanel();
        guiPanel.setBackground(new Color(100,100,100));        
        guiPanel.add(m_Objective);
        btmPanel.add(guiPanel,BorderLayout.NORTH);
        
        guiPanel = new javax.swing.JPanel(); // 
        guiPanel.setBackground(new Color(130,169,193));
        guiPanel.setBorder(BorderFactory.createLineBorder(new Color(67,143,205),4));
        
        guiPanel.add(createInputOutputPanel());
        btmPanel.add(guiPanel,BorderLayout.SOUTH);
        
        
        guiPanel = new javax.swing.JPanel(); // 
        guiPanel.setLayout(new java.awt.GridBagLayout());
        java.awt.GridBagConstraints gridBagConstraints;
        gridBagConstraints = new java.awt.GridBagConstraints();
        gridBagConstraints.insets = new java.awt.Insets(4, 4, 4, 4); 
        guiPanel.setBackground(new Color(219,226,238));
        guiPanel.setBorder(BorderFactory.createLineBorder(new Color(235,233,215),4));
//    	lbl = new JLabel("Clock:", JLabel.CENTER);
//    	ImageIcon icon = m_j3d.createImageIcon("resources/icons/Alarm.png"); 
//    	lbl.setIcon(icon);
//    	lbl.setFont(new Font("Arial", Font.BOLD, 18));
//        guiPanel.add(lbl,gridBagConstraints);	
//        guiPanel.add(outlbl_val[3],gridBagConstraints);
         mixButton = new javax.swing.JButton("Put the solution"); 
        mixButton.setEnabled(false);
        
        guiPanel.add(mixButton, gridBagConstraints);
        
        mixButton.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {       
                    //inputGraph.setLinePosition(simBody.getMixTime());  
            		mixed=true;
            		mixButton.setEnabled(false);
            		counter=0;
            		m_Objective.setText(">: Observe the rotation and rotate the anaylser to take the reading in every 5 min of invterval.");
                    m_Objective.setForeground(Color.WHITE);
            }
          });
        
        lbl = new JLabel("Rotation:", JLabel.CENTER);
        ImageIcon icon = m_j3d.createImageIcon("resources/icons/Contrast.png"); 
    	lbl.setIcon(icon);
    	lbl.setFont(new Font("Arial", Font.BOLD, 18));
    	gridBagConstraints.insets = new java.awt.Insets(4, 50, 4, 4);  
        guiPanel.add(lbl,gridBagConstraints);	
        gridBagConstraints.insets = new java.awt.Insets(4, 4, 4, 4); 
        guiPanel.add(outlbl_val[4],gridBagConstraints); outlbl_val[4].setFont(new Font("Arial", Font.BOLD, 14));
        btmPanel.add(guiPanel,BorderLayout.CENTER);
        
        //HorizontalGraphWrapper gwrapper = new HorizontalGraphWrapper(outputGraph,1,2,Color.GRAY);
       // rightPanel.add(outputGraph);
        
        guiPanel = new javax.swing.JPanel(); // 
        //guiPanel.setBackground(new Color(130,169,193));
        guiPanel.setBorder(BorderFactory.createLineBorder(new Color(235,233,215),4));
        //guiPanel.add(outputGraph);
        //btmPanel.add(guiPanel,BorderLayout.CENTER);
   }
   
   private JPanel createInputOutputPanel(){
   	
   	JPanel ioparm = new JPanel(new java.awt.GridLayout(1,2));
   	//ioparm.setPreferredSize(new java.awt.Dimension(600, 100));
   	ioparm.setBackground(new Color(130,169,193));
   	JPanel parm = new JPanel(new java.awt.GridLayout(4,2,10,0)); 
   	parm.setBackground(new Color(130,169,193));
   	// new  = 
   	
   	int i=0;
   	JLabel lbl = new JLabel("Input Parameters", JLabel.CENTER);   	lbl.setForeground(Color.yellow);				parm.add(lbl);
   	lbl = new JLabel("Values", JLabel.LEFT);    	lbl.setForeground(Color.yellow);				parm.add(lbl);
   	
   	lbl = new JLabel("Concentration of H+", JLabel.LEFT);	parm.add(lbl);
   	outlbl_val[i] = new JLabel(" : 4M", JLabel.LEFT);   						
   	outlbl_val[i].setForeground(Color.white); 				parm.add(outlbl_val[i++]);
   	
   	lbl = new JLabel("Concentration of Cane Sugar", JLabel.LEFT);		parm.add(lbl);   	
   	outlbl_val[i] = new JLabel(" : 5M", JLabel.LEFT);   							
   	outlbl_val[i].setForeground(Color.white); 				parm.add(outlbl_val[i++]);
   	
   	lbl = new JLabel("Wavelength of light", JLabel.LEFT);			parm.add(lbl);   	
   	outlbl_val[i] = new JLabel(" : Na-D light", JLabel.LEFT);   							
   	outlbl_val[i].setForeground(Color.white); 				parm.add(outlbl_val[i++]);
   	
   	
   	ioparm.add(parm);
   	
   	    
   	parm = new JPanel(new java.awt.GridLayout(3,2,0,20)); 
   	parm.setBackground(new Color(130,169,193));
   	lbl = new JLabel("Output ", JLabel.RIGHT);    			parm.add(lbl);
   	lbl = new JLabel("  Parameters", JLabel.LEFT);  		parm.add(lbl);
   	
   	//lbl = new JLabel("Time", JLabel.CENTER);					parm.add(lbl);
   	//outlbl_val[i] = new JLabel(" t min", JLabel.LEFT);   	outlbl_val[i].setFont(new Font("Arial", Font.BOLD, 18));
   	//outlbl_val[i].setForeground(Color.BLUE); 				//parm.add(outlbl_val[i++]);
   	i++;
	lbl = new JLabel("Rotation", JLabel.CENTER);					parm.add(lbl);
   	outlbl_val[i] = new JLabel(" @ deg", JLabel.LEFT);   
   	outlbl_val[i].setForeground(Color.BLUE); 				parm.add(outlbl_val[i++]);
   	
   	
   	//ioparm.add(parm);
   	
   	return  ioparm;
       
   }
   
   

    private void bottomPanel()
    {
    	
    	initInputControlsField();
    	
    	java.awt.GridBagConstraints gridBagConstraints;
	    
	    bottomPanel.setLayout(new java.awt.GridBagLayout());
	    bottomPanel.setBackground(new Color(241,241,235));
	    /*gridBagConstraints = new java.awt.GridBagConstraints();
	    gridBagConstraints.insets = new java.awt.Insets(4, 2, 4, 4);*/
	   
	    int i=0;
	   /* JLabel lbl = new JLabel("Select Substance", JLabel.CENTER);
	    lbl.setForeground(Color.white); 
	    
	    String[] substance = {"Drain Cleaner (13.0)","Hand Soap (10.0)","Blood 7.4","Spit 7.4", "Water 7.0", "Milk 6.5", "Coffee 5.0"
	    					  ,"Beer (4.5)","Beer (4.5)","Soda pop (2.5)","Vomit (2.0)","Battry Acid pop (1.0)","Custom liquid (0.0)"};
		

//      Create the combo box, Indices start at 0
        JComboBox comboList = new JComboBox(substance);
        
        comboList.addActionListener(new java.awt.event.ActionListener() {
        	public void actionPerformed(ActionEvent e) {
        		valChange = true;
                JComboBox cb = (JComboBox)e.getSource();
                String obj = (String)cb.getSelectedItem();
                outlbl_val[0].setText(": " + obj);
                iLabel[0].setText(":: " + obj ); 
            }
    	});*/
        
        gridBagConstraints = new java.awt.GridBagConstraints();
        gridBagConstraints.insets = new java.awt.Insets(4, 30, 4, 4);
        
        
       /* bottomPanel.add(lbl,gridBagConstraints);
        bottomPanel.add(comboList,gridBagConstraints);*/
        
        ////////////////////////Volume///////////////////////////////////////
        
        JLabel lbl = new JLabel("Select Concentration", JLabel.CENTER);
	    //lbl.setForeground(Color.white); 
	    
	    slider1 = new JSlider(JSlider.HORIZONTAL, 0, 10, 5);
	    slider1.addChangeListener(new ChangeListener() {
		    public void stateChanged(ChangeEvent e) {
		    	valChange = true;
		    	int val =((JSlider) e.getSource()).getValue();
		    	fields[0]=val;
		    	outlbl_val[1].setText(" : " + val + "M"); 
		    	iLabel[0].setText(":: " + val + "M"); 
		        
		    }
	    });
	    //slider1.setPreferredSize(new Dimension(150,20));
	    slider1.setBackground(new Color(241,241,235));
	    
	    gridBagConstraints = new java.awt.GridBagConstraints();
        gridBagConstraints.insets = new java.awt.Insets(4, 30, 4, 4);
        
//	    bottomPanel.add(lbl,gridBagConstraints);    	
//        bottomPanel.add(slider1,gridBagConstraints);                
//        bottomPanel.add(iLabel[i++],gridBagConstraints);
        
                
        /////////////////////////////////////////////////////////////////       
        gridBagConstraints = new java.awt.GridBagConstraints();
	    gridBagConstraints.insets = new java.awt.Insets(4, 10, 4, 4);
        
	    
	    
	   // bottomPanel.add(slider2,gridBagConstraints);
        //bottomPanel.add(iLabel[i++],gridBagConstraints);
        
        
	    
	   //enable(0);
	    
    }
    
    private void initInputControlsField(){
       	iLabel = new JLabel[2];
       	int i=0;
       	iLabel[i] = new JLabel("5 M", JLabel.LEFT); iLabel[i++].setForeground(Color.blue);
       	iLabel[i] = new JLabel("0 deg", JLabel.LEFT); iLabel[i++].setForeground(Color.blue);
       	i=0;
       	fields = new float[2];
       	fields[0]=5;
       	fields[1]=0;
           
       }
    private float getConc()
    {
    	float conc=fields[0];
    	return conc;
    	
    }
    private float getTuningTheta()
    {
    	float theta=fields[1];
    	return theta;
    }
   /* private void setField(JLabel lbl, float v, int f){
    	fields[f]= v;
    	lbl.setText(" :: " + Float.toString(fields[f]) + units[f]);
    }*/
    
    
    private  void enable(Container root, boolean enable) {
	    Component children[] = root.getComponents();
	    for(int i = 0; i < children.length; i++) 
			    children[i].setEnabled(enable);
    }
    
    private void enable(int p) {

    	 
	    switch(p){
	    case -1:
	    	slider1.setEnabled(false);iLabel[0].setEnabled(false);
	    	slider2.setEnabled(true); iLabel[1].setEnabled(true);break;
	    case 0:
	    	slider1.setEnabled(false); slider2.setEnabled(false);
	    	iLabel[0].setEnabled(false);iLabel[1].setEnabled(false);
	    	break;
	    case 1: 
	    	slider1.setEnabled(true);	slider2.setEnabled(false);nextButton.setVisible(false);		break;
	    	
	    case 2:
	    	
	    	
	    	break;
	    case 3:
	    	
	    	break;
	    case 4:
	    	
	    	break;	    
	    }
    }
    
    private void onNextStage()
    {
    	    	
    	valChange = true; // Clear the graph. or Graph will restart on Play    	
    	//resetOutputParameters(); // Clear the Output Parameters

    	switch(stage){
    	case 0:   		slider1.setEnabled(false); slider2.setEnabled(false); iLabel[0].setEnabled(false);  iLabel[1].setEnabled(false);		break;
    	case 1:    		slider1.setEnabled(true);iLabel[0].setEnabled(true);	slider2.setEnabled(false); iLabel[1].setEnabled(false);nextButton.setVisible(false);		break;
    	case 2:         stage=0; break;
    	    
    	
    	
    	}
    	
    	//setInstructionText();
    	
    }
    
    public void setInstructionText(){
    	Text3D textGeom = (Text3D)hm.get("obsrv");
    	switch(stage){
    	case 1: // Home //textGeom.setString("What is Periodic Motion? ");
    		textGeom.setString("Does change in mass effect the mime period?");
    		break;
    	case 2:
    		textGeom.setString("Can you change time period by changing initial displacment?");
    		break;
    	case 3:    		
    		textGeom.setString("How length of pendulum and time period are related?");
	    	
    		break;
    	case 4:
    		textGeom.setString("Change different parameter and observe the effect in time period");
    			
    		break;
    	case 5: // Home 
    		enable(0);
    		stage =0;
    		break;
    	}
    	
    }
    
    private void resetOutputParameters()
    {
    	
    }
    

    // Resume Button Action
    private void startSimulation(java.awt.event.ActionEvent evt)
    { 
    	
    	length_2=0.3;
     	length_1=0.4;
     	
    	enable(-1);
       
        mixButton.setEnabled(true);
        reStartButton.setEnabled(false);
        nextButton.setEnabled(false);
        outputGraph.setState(1);
        //outputGraph1.setState(1);
        //startButton.setEnabled(true);
        ImageIcon icon = m_j3d.createImageIcon("resources/icons/stop.png"); 
    	startButton.setIcon(icon);
    	startButton.setText("Stop");
        //bottomPanel.setVisible(false);
    	
///////////
        
        //java.util.BitSet visibleNodes = new java.util.BitSet( switchGroup.numChildren() );
        
        //switchGroup.setChildMask( visibleNodes );
        
        if(valChange){
        	 //intially there is no solution is cylinder
         	java.util.BitSet visibleNodes = new java.util.BitSet( switchGroup.numChildren() );
            for(int i=0; i<3; i++) visibleNodes.set( i ); 
            visibleNodes.set(4);
         	switchGroup.setChildMask( visibleNodes );
         	        	
        	counter=0;  
            lid=true;    //intially lid is there on top cylinder
            
        	mixed=false;
        	float conc=getConc();
        	float theta=getTuningTheta();
        	
        	freeBody.init(conc, 1);
        	freeBody.updateTransform(0);
            outputGraph.clearGraphValue();
            m_table.clearAllData();
            fields[1] =0;
            iLabel[1].setText(":" + 0 + " deg"); 
            update_polarimeter(0);
        	update_line(0);
            //outputGraph1.clearGraphValue();
	        //inputGraph.clearGraphValue();
            m_Objective.setText(">: Put the solution in Polarimeter");
            m_Objective.setForeground(Color.GREEN);
        }
        
        timer.start();
        System.out.println("Timer started");
        
              
    }
    
   
    
    // Resume Button Action
    private void timerActionPerformed(java.awt.event.ActionEvent evt)
    {
    	//System.out.print(counter);
    	if(mixed) //check weather put the solution button is cliked or not 
    	{
    		lid=false;   //make lid on the cylinder disappear
    		if(counter%3==0 && counter<=27 )
    		{
    			Drop drop=(Drop)hm.get( "oil"+(1+counter/3) );
    			drop.setPosition(new Vector3d(0.44, 0.15, 0.0));
    			drop.setVeleocity(new Vector3d(0, -9, 0));
    			drop.setAccerlationY(new Vector3d(0, 0, 0));
    		}
    		for(int i=0;i<=9 && counter<400 ;i++)
    		{
    			Drop drop=(Drop)hm.get("oil"+(i+1));
    			if(drop.getPosition().y >-0.03)
    				drop.update(0.001); 
    			else
    				drop.setPosition(new Vector3d(4,2.3,0.0));
    		}
    		counter++;
    		if(counter<60)
    		{
    			java.util.BitSet visibleNodes = new java.util.BitSet( switchGroup.numChildren() );
    	        for(int i=0; i<3; i++) visibleNodes.set( i ); 
    	        switchGroup.setChildMask( visibleNodes );
    	        
    	        java.util.BitSet visibleNodes1 = new java.util.BitSet( switchGroup.numChildren() );
    	 	   visibleNodes1.set(0);
    	 	   
    	 	   switchGroup1.setChildMask( visibleNodes1 );
    		}
    		
    	}
    	
    	if(counter>60 && !lid)   // the solution is not coming so lid should be visible 
    	{  //counter > 60 means solution is there in cylinder 
    		//here i used lid flag because once the we set lid to visible we don't have to call this again and again so once i set lid on top of cylinder i made lid==true so it won't be called again
    		java.util.BitSet visibleNodes = new java.util.BitSet( switchGroup.numChildren() );
	        for(int i=0; i<3; i++) visibleNodes.set( i );
	        visibleNodes.set(4);  //lid to visible
	        switchGroup.setChildMask( visibleNodes );
	        
	        java.util.BitSet visibleNodes1 = new java.util.BitSet( switchGroup.numChildren() );
 	 	  
 	 	   
 	 	   switchGroup1.setChildMask( visibleNodes1 );
	        lid=true;
	       
    	}
    	
		
    	float  time= (float)freeBody.getTime();
    	float  rotation = (float)freeBody.getRotation();
    	if(counter<60)  //if solution not yet there in the cylinder the rotation of sinwave is zero 
    		rotation=0;
    	float  conc		= (float)freeBody.getConcentration();
    	float theta=getTuningTheta();
    	int angle=(int)(theta);
    	current_polorimeter_angle=theta;
    	//arcs.setCurrentTheta(angle);
    	
        adding_factor-=0.006f; // decides how fast sinwave movess
    	
    	update_Moving_Sinwave(adding_factor,timeperiod_1,length_1,"sin1","line1",new Color3f(0.8f,0.8f,0.0f));
    	update_Moving_Sinwave(adding_factor,timeperiod_2,length_2,"sin2","line2",new Color3f(0.8f,0.8f,0.0f));
    	update_polarimeter(theta);
    	update_line(theta);
    	
    	float diff_angle=current_polorimeter_angle-rotation;
    	if(diff_angle<1 && diff_angle >-1)
    	{
    		arcs.setArcColor("arc2",new Color(255, 192, 203));
    		arcs.setArcColor("arc1",new Color(255, 192, 203));
    		
    	}
    	else
    	{
    		float change=Math.abs(diff_angle)%90;
    		
    		arcs.setArcColor("arc1",new Color((int)((255.0f/90.0f)*change),(int)((255.0f/90.0f)*change),255-(int)((255.0f/90.0f)*change)));
    		arcs.setArcColor("arc2",new Color(255-(int)((255.0f/90.0f)*change), 255-(int)((255.0f/90.0f)*change), 0+(int)((255.0f/90.0f)*change)));
    	}
    		
    	//arcs.setArcIntialAngle("arc1",(int)(90.0f-current_polorimeter_angle));
    	//arcs.setArcIntialAngle("arc2",(int)(270.0f-current_polorimeter_angle));
    	
    	
    	
    	
    	int i=3;;
    	outlbl_val[i++].setText(String.valueOf(time) + " min");
    	if(String.valueOf(rotation).length()>6)
    		outlbl_val[i++].setText(String.valueOf(rotation).substring(0, 6)+ " deg");
    	else
    		outlbl_val[i++].setText(String.valueOf(rotation)+ " deg");
    	if(counter>60)
    	{
    		outputGraph.setCurrentValue(time,rotation);
    		outputGraph.addGraphValue(rotation); // * 700
    		outputGraph.drawGraph();
    	}
        
//        outputGraph1.setCurrentValue(time,conc);
//    	outputGraph1.addGraphValue(conc); // * 700
//        outputGraph1.drawGraph();
    	arcs.drawPieChart();
       //// Change the text
    	
        //freeBody.updateTransform(rotation);
        if(counter>60)   //till the solution comes in cylinder wedon't update
        {
        	freeBody.updateTransform(rotation);
            freeBody.update(); 
        }
       
        
        
        
        return;            
    }
    
    
    private void pauseSimulation()
    {
    	timer.stop();
    	 
    	java.util.BitSet visibleNodes = new java.util.BitSet( switchGroup.numChildren() );
 	    visibleNodes.set( 3);  
 	    if(mixed && counter<60)
 	    {}                           //when the time you pause if the solution is coming from top in that case lid should n't be visbile 
 	    else
 	    	visibleNodes.set(4);
 	    switchGroup.setChildMask( visibleNodes );
    	length_2=0.001;
     	length_1=0.001;
     	adding_factor=0;
     	update_Moving_Sinwave(adding_factor,timeperiod_1,length_1,"sin1","line1",new Color3f(0.8f,0.8f,0.0f));
    	update_Moving_Sinwave(adding_factor,timeperiod_2,length_2,"sin2","line2",new Color3f(0.8f,0.8f,0.0f));
    	    	
		
    	ImageIcon icon = m_j3d.createImageIcon("resources/icons/start.png"); 
    	startButton.setIcon(icon);
    	startButton.setText("Stop");
		reStartButton.setEnabled(true);
        bottomPanel.setVisible(true);
        nextButton.setEnabled(true);
        
    	outputGraph.setState(0);
		//outputGraph1.setState(0);
		enable(stage);
        //startButton.setEnabled(true)t;
		
        valChange = false;
        
       
      
		univ.getCanvas().repaint();
    }
   


    public Group createSinWave(Vector3d pos,double timeperiod,int no_cycles,Vector3d scale,Vector3d rot,Color3f colr,String id,HashMap hmap){
	 
	Transform3D t = new Transform3D();
	  float rad = (float)Math.PI/180;
	   if(rot.x != 0)
		t.rotX(rad*rot.x);
	else if(rot.y != 0)
		t.rotY(rad*rot.y);
	else if(rot.z !=0)
		t.rotZ(rad*rot.z);
	   
     t.setScale(scale);        
     t.setTranslation(pos);
  
     TransformGroup objtrans = new TransformGroup(t);
     
     
     
     double points=2000; //total no of points to be there in one unit distance
     double total_distance= no_cycles*timeperiod/4.0;
     double x=0;
     int size=0;
     for(x=0;x<=total_distance;x=x+(1.0f/points))
     {
    	 size++;
     }
     PointArray wave =new PointArray(size,PointArray.COORDINATES | PointArray.COLOR_3);
     Point3d pnt_verts[] = new Point3d[size];
     
     int i=0;
     for(x=0;i<size;x+=(1.0f/points),i++)
     {
    	 double y= Math.sin((2*Math.PI/timeperiod)*x);
    	 if(y==1 || y==-1 || Math.abs(Math.abs(y)-Math.sqrt(0.5))<0.05)
    	 {
    		objtrans.addChild(m_j3d.createLine(new Point3d(x,0,0), new Point3d(x,y,0),new Vector3d(0,0,0),new Vector3d(1,1,1), new Color3f(4/255.0f,60/255.0f,66/255.0f)));
    		 
    	 }
    	 
    	 pnt_verts[i] = new Point3d(x,  y, 0);
    	 wave.setColor(i,colr);
    	 
     }
     wave.setCoordinates(0, pnt_verts);
     Appearance app = new Appearance();
	 PointAttributes pa = new PointAttributes();
	 pa.setPointSize(2);
	 app.setPointAttributes(pa);
	   
	 Shape3D shape = new Shape3D(wave,app);
     shape.setCapability(Shape3D.ALLOW_GEOMETRY_WRITE | Shape3D.ALLOW_GEOMETRY_READ);
     objtrans.addChild(shape);

     if(id!=null)
    	 hmap.put(id, objtrans);
	    
	return objtrans;
     
}
    public Group cc(Vector3d pos,Vector3d scale,Vector3d rot,float angle,float radius,Color3f color)
    {
	 Transform3D t = new Transform3D();
     float rad = (float)Math.PI/180;
		if(rot.x != 0)
			t.rotX(rad*rot.x);
		else if(rot.y != 0)
			
			t.rotY(rad*rot.y); 
		else if(rot.z != 0)
			t.rotZ(rad*rot.z);
     t.setScale(scale);        
     t.setTranslation(pos);
     int size=2;
     
     int no_oflines=(int) (360.0/angle);
     int i=0;
     TransformGroup objtrans = new TransformGroup(t);
     objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE);
     objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_READ);
	 double theta=0;   
     for(i=0;i<no_oflines;i++)
     {
    	 LineArray line =new LineArray(size,LineArray.COORDINATES | LineArray.COLOR_3);
    	 
    	 line.setColor(0,color);
    	 line.setColor(1,color);
    	 Point3d line_verts[] = new Point3d[size];
    	 Point3d p1=new Point3d(0,0,0);
    	 Point3d p2=new Point3d(0,radius*Math.cos(rad*theta),radius*Math.sin(rad*theta));
    	 
		 line_verts[0] = p1;
		 line_verts[1] = p2;
		 line.setCoordinates(0, line_verts);
		 Appearance app = new Appearance();
		 LineAttributes la = new LineAttributes();
		 la.setLineWidth(2);
		 app.setLineAttributes(la);
		 Shape3D shape = new Shape3D(line,app);
		 objtrans.addChild(shape);
		 
		 theta=theta+angle;
     }
     return objtrans;
 }
public Group createArrowsOnLine( Vector3d pos,Vector3d scale,Vector3d rot,float angle,float radius,Color3f color)
{
	Transform3D t = new Transform3D();
    float rad = (float)Math.PI/180;
		if(rot.x != 0)
			t.rotX(rad*rot.x);
		else if(rot.y != 0)
			
			t.rotY(rad*rot.y); 
		else if(rot.z != 0)
			t.rotZ(rad*rot.z);
    t.setScale(scale);        
    t.setTranslation(pos);
   
    
    int no_oflines=(int) (360.0/angle);
	int i=0;
    TransformGroup objtrans = new TransformGroup(t);
    objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE);
    objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_READ);
	double theta=0;   
	
	//for(i=0;i<no_oflines;i++)
   // {
		    Shape3D shape = new Shape3D();
		    TriangleArray tri = new TriangleArray(3, TriangleArray.COORDINATES|TriangleArray.COLOR_3);
		    tri.setCoordinate(0, new Point3d(0,0.9*radius*Math.cos(rad*(theta+10)),0.9*radius*Math.sin(rad*(theta+10))));
		    tri.setCoordinate(1, new Point3d(0,radius*Math.cos(rad*(theta)),radius*Math.sin(rad*(theta) )));
		    tri.setCoordinate(2,new Point3d(0,0.9*radius*Math.cos(rad*(theta-10)),0.9*radius*Math.sin(rad*(theta=10))) );
		    tri.setColor(0, color);
		    tri.setColor(1, color);
		    tri.setColor(2,color );
		    shape.setGeometry(tri);
		    objtrans.addChild(shape);
		    //theta=theta+angle;
		
            

   // }
	return objtrans;
}
public Group createTriangle(Point3d point1,Point3d point2,Point3d point3,Vector3d scale,Vector3d rot,Color3f color)
{
	Transform3D t = new Transform3D();
    float rad = (float)Math.PI/180;
		if(rot.x != 0)
			t.rotX(rad*rot.x);
		else if(rot.y != 0)
			
			t.rotY(rad*rot.y); 
		else if(rot.z != 0)
			t.rotZ(rad*rot.z);
    t.setScale(scale);    
    TransformGroup objtrans = new TransformGroup(t);
    objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE);
    objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_READ);
    Shape3D shape = new Shape3D();
    TriangleArray tri = new TriangleArray(3, TriangleArray.COORDINATES|TriangleArray.COLOR_3);
    tri.setCoordinate(0, point1);
    tri.setCoordinate(1, point2);
    tri.setCoordinate(2,point3) ;
    tri.setColor(0, color);
    tri.setColor(1, color);
    tri.setColor(2,color );
    shape.setGeometry(tri);
    objtrans.addChild(shape); 
    return objtrans;
   
}
private void update_Moving_Sinwave(float  adding_factor,double timeperiod,double length,String id1,String id2,Color3f colr){
	Shape3D shape = (Shape3D)hm.get(id1);
	shape.setGeometry(setLineSinwave(adding_factor,timeperiod,length,colr,lines_1,colr));
	
}
private void update_polarimeter(float theta)
{
	 Vector3d s = new Vector3d();
	  // Get Scale
	  	
	 TransformGroup objtrans=  (TransformGroup)hm.get("polarimeter");
	 Transform3D trans = new Transform3D();
	 objtrans.getTransform(trans);
	 trans.getScale(s );	
	 float rad = (float)Math.PI/180;
	 trans.rotX(rad*theta);
	 trans.setScale(s);
    trans.setTranslation(new Vector3d(.65,-0.07f,0.726));
	 objtrans.setTransform(trans);
	 }
private void update_line(float theta)
{
	 Vector3d s = new Vector3d();
	  // Get Scale
	  	
	 TransformGroup objtrans=  (TransformGroup)hm.get("line");
	 Transform3D trans = new Transform3D();
	 objtrans.getTransform(trans);
	 trans.getScale(s );	
	 float theta2=-10;
	 float rad = (float)Math.PI/180;
	 trans.rotX(rad*theta);
	 
	 
	 
	 
	 
	 trans.setScale(s);
    trans.setTranslation(new Vector3d(0.529,-0.06,0.8-0.02));
	 objtrans.setTransform(trans);
	 }


public Group createSphere(Vector3d pos,float radius, Color3f ambient, Color3f diffuse,Color3f specular,Color3f emissive,float shine)
{
	   Transform3D tr2 = new Transform3D();
	   tr2.setTranslation(pos);
	   TransformGroup sphereGroup = new TransformGroup(tr2);
	   Appearance app = new Appearance();
	   app.setMaterial(new Material(ambient, emissive,diffuse, specular, shine));
	   sphereGroup.addChild(new Sphere(radius, Sphere.GENERATE_NORMALS, 120,app));
	   return sphereGroup;
	
}

public Group createlineSinwave(Vector3d pos,Vector3d scale,Vector3d rot,double timeperiod,double length,Color3f colr,String id,boolean flag,Color3f color2,HashMap hmap)
{

	Transform3D t = new Transform3D();
	  float rad = (float)Math.PI/180;
	   if(rot.x != 0)
		t.rotX(rad*rot.x);
	else if(rot.y != 0)
		t.rotY(rad*rot.y);
	else if(rot.z !=0)
		t.rotZ(rad*rot.z);
	   
   t.setScale(scale);        
   t.setTranslation(pos);

   TransformGroup objtrans = new TransformGroup(t);
   objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_WRITE);
  objtrans.setCapability(TransformGroup.ALLOW_TRANSFORM_READ);
  objtrans.setCapability(TransformGroup.ALLOW_CHILDREN_EXTEND);
  objtrans.setCapability(TransformGroup.ALLOW_CHILDREN_READ);
  objtrans.setCapability(TransformGroup.ALLOW_CHILDREN_WRITE);
  
  
  
  
  	Appearance app = new Appearance();
  	LineAttributes la = new LineAttributes();
  	la.setLineWidth(1);
  	app.setLineAttributes(la);
  	Shape3D shape = new Shape3D(setLineSinwave(0,timeperiod,length,colr,flag,color2),app);
  	 shape.setCapability(Shape3D.ALLOW_GEOMETRY_WRITE | Shape3D.ALLOW_GEOMETRY_READ);
  if(id!=null)
  { 
	  hmap.put(id,shape);
  }
  	
  objtrans.addChild(shape);
  
  return objtrans;
  
}

public Geometry setLineSinwave(float adding_factor,double timeperiod,double length,Color3f colr,boolean flag,Color3f color2)
{
	
	double points=1000; //total no of points to be there in one unit distance
	  double total_distance= length;
	  double x=0;
	  int size=0;
	  int size2=0;
	  for(x=0;x<=total_distance;x=x+(1.0f/points))
	  {
		  if(flag)
		  {
			  double y= Math.sin((2*Math.PI/timeperiod)*(x+adding_factor));
			  if(y==1 || y==-1 || Math.abs(Math.abs(y)-Math.sqrt(0.5))<0.05)
			  {
				  size2++;
			  }
		  }
	 	 size++;
	  }
	  LineArray line =new LineArray((size+size2-1)*2,LineArray.COORDINATES | LineArray.COLOR_3);
	  
	  Point3d pnt_verts[] = new Point3d[(size+size2-1)*2];
	  int i=0;
	  int count=0;
	  for(x=0;i<size+size2&&count<(size+size2-1)*2;x+=(1.0f/points),i++)
	  {
	 	 	double y= Math.sin((2*Math.PI/timeperiod)*(x+adding_factor));
	 	 	line.setColor(count,colr);
	 	 	pnt_verts[count++]=new Point3d(x,0,0);
	 	 	line.setColor(count,colr);
	 	 	pnt_verts[count++]=new Point3d(x,y,0);
	 	 
	 	 	if(flag && count < (size+size2-1)*2)
	 	 	{
	 	 		if(y==1 || y==-1 || Math.abs(Math.abs(y)-Math.sqrt(0.5))<0.08)
	 	 		{
	 	 			line.setColor(count,color2);
	 	 			pnt_verts[count++]=new Point3d(x,0,0);
	 	 			line.setColor(count,color2);
	 	 			pnt_verts[count++]=new Point3d(x,y,0);
	 	 			i++;
	 		 
	 	 		}
	 	 	}
	  }
	  	line.setCoordinates(0, pnt_verts);
	  	
	  	
	return line;
	  
	
}




	
}///////////////// Defination COmplete


class RotationBody {
	private TransformGroup transgp;
	private Vector3d m_pos;
	 private double k=.00006;          //Rate constant
     private double real_time=0;          //Time -- unit = sec
     private double r_zero=-10;         //Intitial rotation  -- unit = degree
     private double r_inf=13.29;         //Rotation at equilibrium -- unit = degree
     private double r_t=r_zero;        //Rotation at time t -- unit = degree
     private double time_scale=1;   //Time scale factor to increase/decrease speed of expreiment 
     private double t=real_time;   //Simulated time of the experiment -- unit = sec
     private double time_inc=300;    //Incrementing the real_time -- unit = sec

 //next 2 are newly added variables
     
     private double conc_zero=1;			//Initial concentration of sugar solution -- unit = molar
     private double conc_t=conc_zero;			//concentration of sugar solution at time t -- unit = molar
     private double a;
     private double c;
     
     
     public RotationBody(Vector3d pos,TransformGroup tg) 
     {
 	    super();
 	    m_pos=pos;
 	    
 	    transgp=tg;
 	}
    public void init(double conc,double t_scale)
 	{
    	 conc = 0.1;
    	 k = 0.01;     //.00006;
         r_zero = 65.3*10*conc;  //depends on conc
         r_inf = -10.74;
         a = r_zero-r_inf;
         real_time = 0;
         time_inc = .5;  //changed from 300 
         t = real_time;
         r_t = r_zero;
         //next 2 are newly added lines
         conc_zero = conc;
         conc_t = conc_zero;
         
         SetTimeScale(t_scale);
         
 	}
    private void SimulatedRotation()
    {
            //r_t = r_inf + (r_zero-r_inf)*Math.exp(-(k*t)/2.303);
    		r_t = a * Math.exp(-0.01*t) + r_inf;
    }
    /*
     * newly added function
     * function that returns concentration of the cane sugar solution at time t
     * 
     */
    /*private void SimulatedConcentration()
    {
            conc_t = (conc_zero)*Math.exp(-(k*t));
    }*/
    
    public void update()
    {
            t = real_time;
            SimulatedRotation();
          //SimulatedConcentration();//function that calculates concentration at time t
            //conc_t = (conc_zero)*Math.exp(-(k*t));//formula to calculate concentration of sugar solution
            real_time = real_time + (time_inc * time_scale);
    }
    public double getTime()
    {
            return t;
    }
    public double getRotation()
    {
            return r_t;
    }
    
    /*
     * get the value of concentration
     */
    public double getConcentration()
    {
            return conc_t;
    }
    
    public void updateTransform(float rotation){
    	float rad = (float)Math.PI/180;
		  float val =rotation;
		  
		  
		  Transform3D trans = new Transform3D();
		  transgp.getTransform(trans);
		  Vector3d s = new Vector3d();
		  // Get Scale
		  trans.getScale(s );			
		  
		  trans.rotX(rad*val);
		  trans.setScale(s);
		  //trans.setScale(new Vector3d(1f,length,1f));
		  trans.setTranslation(m_pos); //0.05new Vector3d(0,0.47, 0.25)
		  transgp.setTransform(trans);
    	
    }

     
     public void SetTimeScale(double t_scale)
   {
    	 time_scale = t_scale;
   }

}

   

