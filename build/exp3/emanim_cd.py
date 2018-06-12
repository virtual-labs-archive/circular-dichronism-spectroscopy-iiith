#!/usr/bin/python
#

## EMANIM Version 1.01
## by Andras Szilagyi
## See web site at http://www.enzim.hu/~szia/emanim for more information.
##
## This software is in the public domain. Permission to use, copy, modify and distribute this
## software and its documentation for any purpose and without fee is hereby granted,
## without any conditions or restrictions. This software is provided "as is" without
## express or implied warranty.
##
## Note: binary distributions of EMANIM may contain libraries having their own separate
## licensing terms.

from visual import *
from Tkinter import *
from tkColorChooser import *
from tkMessageBox import *
import thread
import tkColorChooser
import time,sys,os

# If while looking at the source, the electric vector of the light coming 
# toward you appears to be rotating clockwise, the light is said to be 
# right-circularly polarized. 
# If counterclockwise, then left-circularly polarized light.

scl=120

def box(a,b,c):
    a=a/2.0
    b=b/2.0
    c=c/2.0
    l1=(-a,-b,-c)
    l2=(-a, b,-c)
    l3=(-a, b, c)
    l4=(-a,-b, c)
    u1=( a,-b,-c)
    u2=( a, b,-c)
    u3=( a, b, c)
    u4=( a,-b, c)
    return [l1,l2,l3,l4,u4,u3,u2,u1,l1,l4,u4,u3,l3,l2,u2,u1,u4]

def tkvcolor(tkc):
    return tuple(map(lambda s:s/255.0,tkc[0]))

def vtkcolor(vc):
    rgb=map(lambda s: int(255*s),vc)
    return '#%02x%02x%02x' % (rgb[0],rgb[1],rgb[2])

class Application(Tk):
    def __init__(self,master=None):
        Tk.__init__(self,master)
        self.protocol('WM_DELETE_WINDOW',self.quitapp)
        self.geometry("-0+0")
        self.title('EMANIM: Control')
        try:
            self.wm_iconbitmap('emanim.ico')
        except:
            pass
        self.resizable(0,0)
        self.CreateWidgets()
        self.grid()
        self.findsizes()
        self.CreateVisObjects()
        #self.SetupScene()
        thread.start_new_thread(self.SetupScene,())
        
    def quitapp(self):
        ms="To exit EMANIM, close the Animation window."
        showinfo(title='Notice',message=ms)
    
    def findsizes(self):
        self.update()
        sw=self.winfo_screenwidth()
        sh=self.winfo_screenheight()
        self.visx=0
        if sw>2*sh:  # desktop extended to multiple monitors
            sw=sw/2
            self.visx=sw/2
        self.viswidth=sw-self.winfo_width()-10
        self.visheight=sh-50
        
    def m1c(self):
        state=self.m1state.get()
	state = 17
        if state==1:
            self.Wa1On.set(1)
            self.Wa2On.set(0)
            self.SumOn.set(0)
            self.w1type.set("Vertical")
            self.ampli1.set(5)
            self.wwll1.set(4.0)
            self.MatOn.set(0)
            self.hid.set(0)
            self.ti.config(text='Vertically polarized wave')
            self.te.config(state=NORMAL)
            self.te.delete("1.0",END)
            self.te.insert(END,'In each point, the electric field vector oscillates in a vertical direction. ')
            self.te.insert(END,'The wave propagates in the direction of the horizontal axis. ')
            self.te.insert(END,'Vary the wavelength and the amplitude of Wave 1 to see how it affects the wave.')
            self.te.config(state=DISABLED)
        elif state==2:
            self.Wa1On.set(0)
            self.Wa2On.set(1)
            self.SumOn.set(0)
            self.w2type.set("Horizontal")
            self.ampli2.set(5)
            self.wwll2.set(4.0)
            self.MatOn.set(0)
            self.hid.set(0)
            self.ti.config(text='Horizontally polarized wave')
            self.te.config(state=NORMAL)
            self.te.delete("1.0",END)
            self.te.insert(END,'In each point, the electric field vector oscillates in a horizontal direction. ')
            self.te.insert(END,'Rotate the scene if the wave is not clearly visible.')
            self.te.config(state=DISABLED)
        elif state==3:
            self.Wa1On.set(1)
            self.Wa2On.set(0)
            self.SumOn.set(0)
            self.w1type.set("Left circular")
            self.ampli1.set(5)
            self.wwll1.set(4.0)
            self.MatOn.set(0)
            self.hid.set(0)
            self.ti.config(text='Left circularly polarized wave')
            self.te.config(state=NORMAL)
            self.te.delete("1.0",END)
            self.te.insert(END,'Here, the electric field vector rotates in a circle instead of oscillating. Its magnitude ')
            self.te.insert(END,'is constant, only its direction varies with time. When looking at the source of the light, ')
            self.te.insert(END,'the vector appears to be rotating counter-clockwise.')
            self.te.config(state=DISABLED)
        elif state==4:
            self.Wa1On.set(0)
            self.Wa2On.set(1)
            self.SumOn.set(0)
            self.w2type.set("Right circular")
            self.ampli2.set(5)
            self.wwll2.set(4.0)
            self.MatOn.set(0)
            self.hid.set(0)
            self.ti.config(text='Right circularly polarized wave')
            self.te.config(state=NORMAL)
            self.te.delete("1.0",END)
            self.te.insert(END,'In each point on the horizontal axis, the electric field vector is seen rotating clockwise ')
            self.te.insert(END,'when looking towards the light source.')
            self.te.config(state=DISABLED)
        elif state==5:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Vertical')
            self.w2type.set('Horizontal')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.SumOn.set(1)
            self.MatOn.set(0)
            self.phase.set(0)
            self.hid.set(0)
            self.ti.config(text='Linear + Linear = Linear')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When a horizontally and a vertically polarized wave, having the same wavelength and ')
            self.te.insert(END,'amplitude and oscillating in the same phase, are superposed, the resulting wave ')
            self.te.insert(END,'is another linearly polarized wave, which oscillates in a 45 degree angle ')
            self.te.insert(END,'relative to the two component waves. Vary the amplitudes and the phase difference ')
            self.te.insert(END,'to see what happens.')
            self.te.config(state=DISABLED)
        elif state==6:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Vertical')
            self.w2type.set('Horizontal')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.SumOn.set(1)
            self.MatOn.set(0)
            self.phase.set(90)
            self.hid.set(0)
            self.ti.config(text='Linear + Linear = Circular')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When a horizontally and a vertically polarized wave, having the same wavelength and ')
            self.te.insert(END,'amplitude but a phase difference of 90 degrees, are superposed, the resulting wave ')
            self.te.insert(END,'is a left circularly polarized wave. Set the phase difference to -90 degrees ')
            self.te.insert(END,'to see what happens to the polarization')
            self.te.config(state=DISABLED)
        elif state==7:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Left circular')
            self.w2type.set('Right circular')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.SumOn.set(1)
            self.MatOn.set(0)
            self.phase.set(90)
            self.hid.set(0)
            self.ti.config(text='Left circular + Right circular = Linear')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When a left and a right circularly polarized wave, having the same wavelength and ')
            self.te.insert(END,'amplitude, are superposed, the resulting wave ')
            self.te.insert(END,'is a linearly polarized wave. This also means that any linearly polarized wave can ')
            self.te.insert(END,'be obtained as the superposition of a left and a right circularly polarized wave. ')
            self.te.insert(END,'Vary the phase difference to see how it affects the direction of polarization of ')
            self.te.insert(END,'the resulting wave.')
            self.te.config(state=DISABLED)
        elif state==8:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Vertical')
            self.w2type.set('Vertical')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.SumOn.set(1)
            self.MatOn.set(0)
            self.phase.set(0)
            self.hid.set(0)
            self.ti.config(text='Wavelength ratio 1:1')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'Two identical, vertically polarized waves are superposed (you might not see both ')
            self.te.insert(END,'of them because they cover each other). The result is a wave having double the ')
            self.te.insert(END,'amplitude of the component waves. Vary the phase difference to see how it ')
            self.te.insert(END,'affects the amplitude of the resulting wave! What happens when the phase difference ')
            self.te.insert(END,'is 180 degrees?')
            self.te.config(state=DISABLED)
        elif state==9:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Vertical')
            self.w2type.set('Vertical')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(1)
            self.wwll2.set(8)
            self.SumOn.set(1)
            self.MatOn.set(0)
            self.phase.set(0)
            self.hid.set(0)
            self.ti.config(text='Wavelength ratio 1:8')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'A short-wavelength wave is superposed on a longer-wavelength wave.')
            self.te.config(state=DISABLED)
        elif state==10:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Vertical')
            self.w2type.set('Vertical')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(7)
            self.wwll2.set(8)
            self.SumOn.set(1)
            self.MatOn.set(0)
            self.phase.set(0)
            self.hid.set(0)
            self.ti.config(text='Wavelength ratio 7:8')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'Two waves with a very small wavelength difference are superposed (the wavelengths are ')
            self.te.insert(END,'7 and 8). Observe the waves over a longer period of time and notice how at some points ')
            self.te.insert(END,'the two waves add constructively (the resulting amplitude is high) and at other points ')
            self.te.insert(END,'they add destructively (the resulting amplitude is close to zero).')
            self.te.config(state=DISABLED)
        elif state==11:
            self.Wa1On.set(1)
            self.Wa2On.set(0)
            self.w1type.set('Vertical')
            self.ampli1.set(5)
            self.wwll1.set(4)
            self.SumOn.set(0)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w1e.set(0.25)
            self.w1n.set(1.0)
            self.hid.set(0)
            self.ti.config(text='Absorption')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When light crosses matter, the matter absorbs part of the light. As a result, ')
            self.te.insert(END,'the amplitude of the light decreases. The extinction coefficient determines ')
            self.te.insert(END,'how much of the light is absorbed by unit length of material. Vary the ')
            self.te.insert(END,'length of the material and the extinction coefficient for Wave 1 to see ')
            self.te.insert(END,'how it affects the absorption.')
            self.te.config(state=DISABLED)
        elif state==12:
            self.Wa1On.set(1)
            self.Wa2On.set(0)
            self.w1type.set('Vertical')
            self.ampli1.set(5)
            self.wwll1.set(4)
            self.SumOn.set(0)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w1e.set(0)
            self.w1n.set(1.5)
            self.hid.set(0)
            self.ti.config(text='Refraction')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'Light is slower in matter than in vacuum. Because of this, when light enters ')
            self.te.insert(END,'a piece of material, its wavelength becomes shorter. The refractive index of the ')
            self.te.insert(END,'material determines how slow the light becomes and how much its wavelength shortens. ')
            self.te.insert(END,'Vary the refraction index for Wave 1 to see its effect.')
            self.te.config(state=DISABLED)
        elif state==13:
            self.Wa1On.set(1)
            self.Wa2On.set(0)
            self.w1type.set('Vertical')
            self.ampli1.set(5)
            self.wwll1.set(4)
            self.SumOn.set(0)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w1e.set(0.25)
            self.w1n.set(1.5)
            self.hid.set(0)
            self.ti.config(text='Absorbtion + refraction')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'Matter usually exhibits both absorption and refraction, i.e. light entering a piece of ')
            self.te.insert(END,'material will both weaken and slow down. This results in decreased amplitude and ')
            self.te.insert(END,'wavelength. Vary the length of the material, the extinction coefficient and the ')
            self.te.insert(END,'refraction index for Wave 1 to see the effects of these parameters.')
            self.te.config(state=DISABLED)
        elif state==14:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Vertical')
            self.w2type.set('Horizontal')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.phase.set(0)
            self.SumOn.set(1)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w2smon.set(0)
            self.w1e.set(0.15)
            self.w2e.set(0)
            self.w1n.set(1)
            self.w2n.set(1)
            self.hid.set(0)
            self.ti.config(text='Linear dichroism')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When material is anisotropic (exhibits different properties for different directions), ')
            self.te.insert(END,'its extinction coefficient may differ for horizontally and vertically polarized light. ')
            self.te.insert(END,'Here, the input is a horizontally and a vertically polarized wave; their superposition ')
            self.te.insert(END,'is a wave polarized in a plane making a 45 degree angle with the horizontal plane. ')
            self.te.insert(END,'Because the material only absorbs the vertical component, the output will be a wave ')
            self.te.insert(END,'polarized in a plane closer to the horizontal plane. Vary both extinction coefficients, ')
            self.te.insert(END,'the length of the material and the phase difference between the waves to see their ')
            self.te.insert(END,'effects on the output.')
            self.te.config(state=DISABLED)
        elif state==15:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Vertical')
            self.w2type.set('Horizontal')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.phase.set(0)
            self.SumOn.set(1)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w2smon.set(0)
            self.w1e.set(0)
            self.w2e.set(0)
            self.w1n.set(1.05)
            self.w2n.set(1)
            self.hid.set(0)
            self.ti.config(text='Linear birefringence')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When material is anisotropic (exhibits different properties for different directions), ')
            self.te.insert(END,'its refraction index may differ for horizontally and vertically polarized light. ')
            self.te.insert(END,'Here, the input is a horizontally and a vertically polarized wave; their superposition ')
            self.te.insert(END,'is a wave polarized in a plane making a 45 degree angle with the horizontal plane. ')
            self.te.insert(END,'Because the material only refracts (slows down) the vertical component, the phase ')
            self.te.insert(END,'difference between the two waves will alter while the light crosses the material. As a ')
            self.te.insert(END,'result, the originally plane-polarized input wave becomes elliptically polarized on the ')
            self.te.insert(END,'output. Vary both refraction indices and the length of material to see how they affect ')
            self.te.insert(END,'the polarization of the output.')
            self.te.config(state=DISABLED)
        elif state==16:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Vertical')
            self.w2type.set('Horizontal')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.phase.set(0)
            self.SumOn.set(1)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w2smon.set(0)
            self.w1e.set(0.15)
            self.w2e.set(0)
            self.w1n.set(1.05)
            self.w2n.set(1)
            self.hid.set(0)
            self.ti.config(text='Linear dichroism and birefringence')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When material is anisotropic (exhibits different properties for different directions), ')
            self.te.insert(END,'both its refraction index and its extinction coefficient may differ for horizontally ')
            self.te.insert(END,'and vertically polarized light. Here, the input is a horizontally and a vertically ')
            self.te.insert(END,'polarized wave; their superposition is a wave polarized in a plane making a 45 degree ')
            self.te.insert(END,'angle with the horizontal plane. The material only affects the vertical component. After ')
            self.te.insert(END,'crossing the material, the resulting polarization plane gets closer to the horizontal ')
            self.te.insert(END,'direction (because of the linear dichroism) and the plane-polarized light becomes ')
            self.te.insert(END,'elliptically polarized (because of the linear birefringence). Vary the extinction ')
            self.te.insert(END,'coefficients and the refraction indices as well as the length of material to see how ')
            self.te.insert(END,'they affect the polarization of the output.')
            self.te.config(state=DISABLED)
        elif state==17:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Left circular')
            self.w2type.set('Right circular')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.phase.set(0)
            self.SumOn.set(1)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w2smon.set(0)
            self.w1e.set(0.15)
            self.w2e.set(0)
            self.w1n.set(1)
            self.w2n.set(1)
            self.hid.set(0)
            self.ti.config(text='Circular dichroism')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
	    self.te.insert(END,'CD')
            """self.te.insert(END,'When material is optically active (exhibits different properties for left and right ')
            self.te.insert(END,'circularly polarized light), its extinction coefficient may differ for left and right ')
            self.te.insert(END,'circularly polarized light. ')
            self.te.insert(END,'Here, the input is a left and a right circularly polarized wave; their superposition ')
            self.te.insert(END,'is a wave polarized in a horizontal plane. ')
            self.te.insert(END,'The material only affects the left circular component: it weakens it so that the ')
            self.te.insert(END,'output is a wave that is elliptically polarized. The long axis of the ellipse lies in ')
            self.te.insert(END,'the same plane as the polarization plane of the input wave. ')
            self.te.insert(END,'Vary the extinction coefficients and the length of the material to see their effects.')"""
            self.te.config(state=DISABLED)
        elif state==18:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Left circular')
            self.w2type.set('Right circular')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.phase.set(0)
            self.SumOn.set(1)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w2smon.set(0)
            self.w1e.set(0)
            self.w2e.set(0)
            self.w1n.set(1.05)
            self.w2n.set(1)
            self.hid.set(0)
            self.ti.config(text='Circular birefringence')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When material is optically active (exhibits different properties for left and right ')
            self.te.insert(END,'circularly polarized light), its refraction index may differ for left and right ')
            self.te.insert(END,'circularly polarized light. ')
            self.te.insert(END,'Here, the input is a left and a right circularly polarized wave; their superposition ')
            self.te.insert(END,'is a wave polarized in a horizontal plane. ')
            self.te.insert(END,'The material only affects the left circular component: it slows it down so that the ')
            self.te.insert(END,'phase difference between the two waves alters while the light crosses the material. ')
            self.te.insert(END,'As a result, the plane of polarization of the output wave is rotated relative to ')
            self.te.insert(END,'the input wave but it remains plane-polarized. Vary the refraction indices to see how ')
            self.te.insert(END,'affect the polarization direction of the output wave.')
            self.te.config(state=DISABLED)
        elif state==19:
            self.Wa1On.set(1)
            self.Wa2On.set(1)
            self.w1type.set('Left circular')
            self.w2type.set('Right circular')
            self.ampli1.set(5)
            self.ampli2.set(5)
            self.wwll1.set(4)
            self.wwll2.set(4)
            self.phase.set(0)
            self.SumOn.set(1)
            self.MatOn.set(1)
            self.matlen.set(16)
            self.w2smon.set(0)
            self.w1e.set(0.15)
            self.w2e.set(0)
            self.w1n.set(1.05)
            self.w2n.set(1)
            self.hid.set(0)
            self.ti.config(text='Circular dichroism and birefringence')
            self.te.config(state=NORMAL)
            self.te.delete('1.0',END)
            self.te.insert(END,'When material is optically active (exhibits different properties for left and right ')
            self.te.insert(END,'circularly polarized light), both its extinction coefficient and refraction index may ')
            self.te.insert(END,'differ for left and right circularly polarized light. ')
            self.te.insert(END,'Here, the input is a left and a right circularly polarized wave; their superposition ')
            self.te.insert(END,'is a wave polarized in a horizontal plane. ')
            self.te.insert(END,'The material only affects the left circular component. The output wave is elliptically ')
            self.te.insert(END,'polarized (because of the circular dichroism) and the long axis of this ellipse is ')
            self.te.insert(END,'rotated relative to the polarization plane of the input wave (because of the circular ')
            self.te.insert(END,'birefringence). Vary the extinction coefficients and refraction indices to see their ')
            self.te.insert(END,'effects on the polarization type and direction of the output wave.')
            self.te.config(state=DISABLED)

    def m2nice(self):
        self.hid.set(0)
        scene.forward=norm(vector(-0.669,-0.223,-0.708))
    def m2side(self):
        self.hid.set(0)
        scene.forward=(0,0,-1)
    def m2front(self):
        self.hid.set(0)
        scene.forward=(-1,0,0)
    def m2back(self):
        self.hid.set(0)
        scene.forward=(1,0,0)
    def m2veconly(self):
        self.hid.set(1)
        scene.forward=norm(vector(-0.95,-0.13,-0.26))

    def m3bg(self):
        bgc=askcolor(color=vtkcolor(scene.background))
        scene.background=tkvcolor(bgc)
        self.lw1.config(fg=bgc[1])
        self.lw2.config(fg=bgc[1])
        self.lws.config(fg=bgc[1])
        self.lwm.config(fg=bgc[1])
    def m3w1(self):
        w1c=askcolor(color=vtkcolor(self.w1.color[0]))
        self.lw1.config(bg=w1c[1])
        self.w1.color=tkvcolor(w1c)
        self.arr1a.color=self.w1.color[0]
        self.arr1b.color=self.w1.color[0]
    def m3w2(self):
        w2c=askcolor(color=vtkcolor(self.w2.color[0]))
        self.lw2.config(bg=w2c[1])
        self.w2.color=tkvcolor(w2c)
        self.arr2a.color=self.w2.color[0]
        self.arr2b.color=self.w2.color[0]
    def m3sc(self):
        wsc=askcolor(color=vtkcolor(self.sc.color[0]))
        self.lws.config(bg=wsc[1])
        self.sc.color=tkvcolor(wsc)
        self.arrsa.color=self.sc.color[0]
        self.arrsb.color=self.sc.color[0]
    def m3mat(self):
        wmc=askcolor(color=vtkcolor(self.mat.color[0]))
        self.lwm.config(bg=wmc[1])
        self.mat.color=tkvcolor(wmc)
    def m3ax(self):
        axcolor=tkvcolor(askcolor(color=vtkcolor(self.axes[0].color[0])))
        for ao in self.axes:
            ao.color=axcolor
    def m3hlp(self):
        slcolor=tkvcolor(askcolor(color=vtkcolor(self.sl1a.color[0])))
        self.sl1a.color=slcolor
        self.sl1b.color=slcolor
        self.sl2a.color=slcolor
        self.sl2b.color=slcolor
    def m3reset(self):
        scene.background=color.black
        self.w1.color=color.red
        self.arr1a.color=color.red
        self.arr1b.color=color.red
        self.w2.color=color.green
        self.arr2a.color=color.red
        self.arr2b.color=color.red
        self.sc.color=color.cyan
        self.arrsa.color=color.cyan
        self.arrsb.color=color.cyan
        self.mat.color=color.orange
        self.lw1.config(fg="#000000",bg="#ff0000")
        self.lw2.config(fg="#000000",bg="#00ff00")
        self.lws.config(fg="#000000",bg="#00ffff")
        self.lwm.config(fg="#000000",bg="#ff8000")
        self.sl1a.color=color.yellow
        self.sl2a.color=color.yellow
        self.sl1b.color=color.yellow
        self.sl2b.color=color.yellow
        for ao in self.axes:
            ao.color=(.3,.3,.3)

    def overview(self):
        ms='EMANIM Overview\n\n'
        ms+='EMANIM animates electromagnetic waves in vacuum and in matter. For clarity, only the electric component is '
        ms+='shown at all times (the magnetic component is always perpendicular to the electric component and its '
        ms+='magnitude oscillates in the same phase as that of the electric component).\n\n'
        ms+='In EMANIM, you can set up two waves (Wave 1 and Wave 2) with selectable polarization (horizontal, '
        ms+='vertical, left circular or right circular) and you can show their superposition (Wave 1 + Wave 2). '
        ms+='The waves as they move forward are shown between two planes; the electric field vectors are displayed '
        ms+='at the planes. Using the controls, the amplitudes and wavelengths of the waves as well as their phase '
        ms+='difference (the phase of Wave 2 relative to Wave 1) can be adjusted.\n\n'
        ms+='To study the interaction between light and matter, a piece of material can be inserted '
        ms+='between the two planes. The length of this material as well as its extinction coefficients '
        ms+='and indices of refraction for both waves can be adjusted using the controls.\n\n'
        ms+='The rate of the animation can be set, and there is an option to only show the vectors at the '
        ms+='planes without the wave profiles in between so that the movement of the vectors can be easier to compare.\n\n'
        ms+='Using the Phenomenon menu, you can select from several predefined sets of parameters corresponding to '
        ms+='various electromagnetic phenomena. When a phenomenon is selected, a short explanation of it '
        ms+='is displayed.\n\n'
        ms+='The View menu contains a few predefined camera angles for easier viewing of the scene. '
        ms+='If you do not like the default color scheme, you can set up your own colors using the '
        ms+='Color menu.\n\n'
        showinfo(title='Overview',message=ms)
    def usage(self):
        ms='Controlling the view in the Animation window:\n\n'
        ms+='To ROTATE the scene: hold down the RIGHT mouse button (shift key on Macintosh) '
        ms+='and drag the mouse.\n\n'
        ms+='To ZOOM into and out of the scene: Hold down the MIDDLE mouse button '
        ms+='(left+right buttons on a two-button mouse; control key on Macintosh) and '
        ms+='drag the mouse.\n\n'
        ms+='NOTE: Resizing the Animation window is NOT recommended because it may result in '
        ms+='decreased performance. It is best to use it in its original size.'
        showinfo(title='Mouse controls',message=ms)
    def about(self):
        ms='EMANIM Version 1.0\n'
        ms+='by Andras Szilagyi\n'
        ms+='See web site at http://www.enzim.hu/~szia/emanim for more information.\n\n'
        ms+='This software is in the public domain. Permission to use, copy, modify and distribute this '
        ms+='software and its documentation for any purpose and without fee is hereby granted, '
        ms+='without any conditions or restrictions. This software is provided "as is" without '
        ms+='express or implied warranty.\n\n'
        ms+='Note: binary distributions of EMANIM may contain libraries having their own separate '
        ms+='licensing terms.'
        showinfo(title='About',message=ms)
        
    def CreateWidgets(self):
        mb=Menu(self)
        me1=Menu(mb,tearoff=0)
        me2=Menu(mb,tearoff=0)
        me3=Menu(mb,tearoff=0)
        me4=Menu(mb,tearoff=0)
        mb.add_cascade(label='Phenomenon',menu=me1)
        m1s1=Menu(me1,tearoff=0)
        self.m1state=IntVar()
        self.m1state.set(1)
        """m1s1.add_radiobutton(label='Vertical',command=self.m1c,variable=self.m1state,value=1)
        m1s1.add_radiobutton(label='Horizontal',command=self.m1c,variable=self.m1state,value=2)
        m1s1.add_radiobutton(label='Left circular',command=self.m1c,variable=self.m1state,value=3)
        m1s1.add_radiobutton(label='Right circular',command=self.m1c,variable=self.m1state,value=4)
        me1.add_cascade(label='Polarization',menu=m1s1)
        m1s2=Menu(me1,tearoff=0)
        m1s2.add_radiobutton(label='Linear+linear 1',command=self.m1c,variable=self.m1state,value=5)
        m1s2.add_radiobutton(label='Linear+linear 2',command=self.m1c,variable=self.m1state,value=6)
        m1s2.add_radiobutton(label='Left+right circular',command=self.m1c,variable=self.m1state,value=7)
        me1.add_cascade(label='Superpositions',menu=m1s2)
        m1s3=Menu(me1,tearoff=0)
        m1s3.add_radiobutton(label='Wavelength ratio 1:1',command=self.m1c,variable=self.m1state,value=8)
        m1s3.add_radiobutton(label='Wavelength ratio 1:8',command=self.m1c,variable=self.m1state,value=9)
        m1s3.add_radiobutton(label='Wavelength ratio 7:8',command=self.m1c,variable=self.m1state,value=10)
        me1.add_cascade(label='Interference',menu=m1s3)
        m1s4=Menu(me1,tearoff=0)
        m1s4.add_radiobutton(label='Absorption',command=self.m1c,variable=self.m1state,value=11)
        m1s4.add_radiobutton(label='Refraction',command=self.m1c,variable=self.m1state,value=12)
        m1s4.add_radiobutton(label='Abs. & Refr.',command=self.m1c,variable=self.m1state,value=13)
        me1.add_cascade(label='Material: Basic',menu=m1s4)
        m1s5=Menu(me1,tearoff=0)
        m1s5.add_radiobutton(label='Linear dichroism',command=self.m1c,variable=self.m1state,value=14)
        m1s5.add_radiobutton(label='Linear birefringence',command=self.m1c,variable=self.m1state,value=15)
        m1s5.add_radiobutton(label='Lin. dichr. & birefr.',command=self.m1c,variable=self.m1state,value=16)
        me1.add_cascade(label='Material: Anisotropy',menu=m1s5)"""
        m1s6=Menu(me1,tearoff=0)
        m1s6.add_radiobutton(label='Circular dichroism',command=self.m1c,variable=self.m1state,value=17)
        """ m1s6.add_radiobutton(label='Circular birefringence',command=self.m1c,variable=self.m1state,value=18)
        m1s6.add_radiobutton(label='Circ. dichr. & birefr.',command=self.m1c,variable=self.m1state,value=19)"""
        me1.add_cascade(label='Material: Optical activity',menu=m1s6)
        mb.add_cascade(label='View',menu=me2)
        me2.add_command(label='Nice',command=self.m2nice)
        me2.add_command(label='Side',command=self.m2side)
        me2.add_command(label='Front',command=self.m2front)
        me2.add_command(label='Back',command=self.m2back)
        me2.add_command(label='Vectors only',command=self.m2veconly)
        mb.add_cascade(label='Colors',menu=me3)
        me3.add_command(label='Background',command=self.m3bg)
        me3.add_command(label='Wave 1',command=self.m3w1)
        me3.add_command(label='Wave 2',command=self.m3w2)
        me3.add_command(label='Wave 1 + Wave 2',command=self.m3sc)
        me3.add_command(label='Material',command=self.m3mat)
        me3.add_command(label='Axes',command=self.m3ax)
        me3.add_command(label='Helper lines',command=self.m3hlp)
        me3.add_command(label='Reset',command=self.m3reset)
        mb.add_cascade(label='Help',menu=me4)
        me4.add_command(label='Overview',command=self.overview)
        me4.add_command(label='Mouse controls',command=self.usage)
        me4.add_command(label='About',command=self.about)
        self.config(menu=mb)
        self.ti=Label(self,fg="#0000ff")
        self.ti.grid(column=0,row=0,columnspan=2,sticky=E+W)
        desc=Frame(self)
        desc.grid(column=0,row=1,columnspan=2)
        tesc=Scrollbar(desc,orient=VERTICAL)
        tesc.grid(column=1,row=0)
        self.te=Text(desc,height=4,width=45,wrap=WORD,yscrollcommand=tesc.set)
        self.te.configure(state=DISABLED)
        tesc.configure(command=self.te.yview)
        self.te.grid(column=0,row=0)
        w1frame=Frame(self,bd=2,relief=RIDGE)
        w1frame.grid(column=0,row=2,padx=5,pady=5,sticky=N)
        w2frame=Frame(self,bd=2,relief=RIDGE)
        w2frame.grid(column=1,row=2,padx=5,pady=5,rowspan=2,sticky=N)
        wsframe=Frame(self,bd=2,relief=RIDGE)
        wsframe.grid(column=0,row=3,padx=5,pady=5,sticky=N)
        wmframe=Frame(self,bd=2,relief=RIDGE)
        wmframe.grid(column=0,row=4,padx=5,pady=5,columnspan=2,sticky=N)
        self.Wa1On=IntVar()
        self.lw1=Checkbutton(w1frame,variable=self.Wa1On,text="Wave 1",bg="#ff0000")
        self.lw1.grid(column=0,row=0,sticky=N+E+S+W)
        self.Wa2On=IntVar()
        self.lw2=Checkbutton(w2frame,variable=self.Wa2On,text="Wave 2",bg="#00ff00")
        self.lw2.grid(column=0,row=0,sticky=N+E+S+W)
        self.SumOn=IntVar()
        self.lws=Checkbutton(wsframe,variable=self.SumOn,text="Wave 1 + Wave 2",bg="#00ffff")
        self.lws.grid(column=0,row=0,sticky=N+E+S+W)
        self.MatOn=IntVar()
        self.lwm=Checkbutton(wmframe,variable=self.MatOn,text="Material",bg="#ff8000")
        self.lwm.grid(column=0,row=0,columnspan=2,sticky=N+E+S+W)
        w1tlab=Label(w1frame,text="Polarization:")
        w1tlab.grid(sticky=W,column=0)
        w2tlab=Label(w2frame,text="Polarization:")
        w2tlab.grid(sticky=W,column=0)
        self.w1type=StringVar()
        self.w1type.set("Vertical")
        w1opt=OptionMenu(w1frame,self.w1type,"Horizontal","Vertical","Left circular","Right circular")
        w1opt.grid(column=0)
        self.w2type=StringVar()
        self.w2type.set("Horizontal")
        w2opt=OptionMenu(w2frame,self.w2type,"Horizontal","Vertical","Left circular","Right circular")
        w2opt.grid(column=0)
        
        self.ampli1=IntVar()
        Amp1=Scale(w1frame,from_=0,to=10,label="Amplitude:",variable=self.ampli1,orient=HORIZONTAL,length=scl)
        Amp1.grid(column=0)
        self.ampli2=self.ampli1
        Amp2=Scale(w2frame,from_=0,to=10,label="Amplitude:",variable=self.ampli1,orient=HORIZONTAL,length=scl)
        Amp2.grid(column=0)
        self.wwll1=DoubleVar()
        WL1=Scale(w1frame,from_=200,to=600,label="Wavelength:",variable=self.wwll1,orient=HORIZONTAL,length=scl)
        WL1.grid(column=0)
        self.wwll2=self.wwll1
        WL2=Scale(w2frame,from_=200,to=600,label="Wavelength:",variable=self.wwll1,orient=HORIZONTAL,length=scl)
        WL2.grid(column=0)
        self.phase=DoubleVar()
        phd=Scale(w2frame,from_=-180,to=180,label="Phase difference:",variable=self.phase,orient=HORIZONTAL,
        resolution=10,length=scl)
        phd.grid(column=0)
        self.matlen=DoubleVar()
        self.matlen.set(16)
        mlscale=Scale(wmframe,from_=1,to=32,label="Length",variable=self.matlen,orient=HORIZONTAL,resolution=1,length=scl*2)
        mlscale.grid(column=0,columnspan=2)
        w1pf=LabelFrame(wmframe,text="For Wave 1",bd=2,relief=RIDGE)
        self.w1e=DoubleVar()
        w1ex=Scale(w1pf,from_=0.0,to=1.0,label="Extinction coefficient",variable=self.w1e,
        resolution=0.05,orient=HORIZONTAL,length=scl,command=self.w1excom)
        self.w1n=DoubleVar()
        w1ri=Scale(w1pf,from_=1.0,to=2.0,label="Refraction index",variable=self.w1n,
        resolution=0.05,orient=HORIZONTAL,length=scl,command=self.w1ricom,state=DISABLED)
        w1dm=Label(w1pf,text=" ")
        w1pf.grid(column=0,padx=5,pady=5,sticky=N+S)
        w1ex.grid(column=0)
        w1ri.grid(column=0)
        w1dm.grid(column=0)
        w2pf=LabelFrame(wmframe,text="For Wave 2",bd=2,relief=RIDGE)
        self.w2e=DoubleVar()
        w2ex=Scale(w2pf,from_=0.0,to=1.0,label="Extinction coefficient",variable=self.w2e,
        resolution=0.05,orient=HORIZONTAL,length=scl,command=self.w2excom)
        self.w2n=DoubleVar()
        w2ri=Scale(w2pf,from_=1.0,to=2.0,label="Refraction index",variable=self.w2n,
        resolution=0.05,orient=HORIZONTAL,length=scl,command=self.w2ricom,state=DISABLED)
        self.w2smon=IntVar()
        w2smcb=Checkbutton(w2pf,text="Same as Wave 1",variable=self.w2smon,command=self.w2same)
        w2pf.grid(column=1,row=2,padx=5,pady=5,sticky=N+S)
        w2ex.grid(column=0)
        w2ri.grid(column=0)
        w2smcb.grid(column=0)
        self.hid=IntVar()
        self.hid.set(0)
        hidw=Checkbutton(self,text="Show vectors only",variable=self.hid)
        hidw.grid(column=0,row=5)
        self.arate=IntVar()
        self.arate.set(30)
        ratsc=Scale(self,from_=1,to=150,label="Animation rate",variable=self.arate,
        orient=HORIZONTAL,length=scl)
        ratsc.grid(column=1,row=5)

        self.m1c()
        self.m2nice()
        
    def w2same(self):
        if self.w2smon.get():
            self.w2e.set(self.w1e.get())
            self.w2n.set(self.w1n.get())
    def w1excom(self,v):
        if self.w2smon.get():
            self.w2e.set(v)
    def w1ricom(self,v):
        if self.w2smon.get():
            self.w2n.set(v)
    def w2excom(self,v):
        if self.w2smon.get():
            self.w1e.set(v)
    def w2ricom(self,v):
        if self.w2smon.get():
            self.w1n.set(v)

        
    def CreateVisObjects(self):
        scene.x,scene.y=self.visx,0
        scene.width,scene.height=self.viswidth,self.visheight
        scene.autocenter=0
        scene.autoscale=0
        scene.title='EMANIM: Animation'
        scene.range=27.0
        scene.fov=pi/12
        step=pi/18
        pih=pi/2
        
        Amp1=4.0
        Amp2=4.0
        SqAmp=1.5*max(Amp1,Amp2)
        amp=4.0
        
        x=arange(-8*pi,8*pi+step,step)


        self.w1=curve(x=x,color=color.red,radius=.1,visible=1)
        self.w2=curve(x=x,color=color.green,radius=.1,visible=0)
        self.sc=curve(x=x,color=color.cyan,radius=.2,visible=0)
        axis=curve(x=[-8*pi,8*pi],color=(.3,.3,.3))
        sq1=curve(pos=[(-8*pi,-SqAmp,-SqAmp),(-8*pi,-SqAmp,SqAmp),
        (-8*pi,SqAmp,SqAmp),(-8*pi,SqAmp,-SqAmp),(-8*pi,-SqAmp,-SqAmp)],
        color=(.3,.3,.3))
        sq2=curve(pos=[(8*pi,-SqAmp,-SqAmp),(8*pi,-SqAmp,SqAmp),
        (8*pi,SqAmp,SqAmp),(8*pi,SqAmp,-SqAmp),(8*pi,-SqAmp,-SqAmp)],
        color=(.3,.3,.3))
        c1y=curve(pos=[(-8*pi,-1.5*amp,0),(-8*pi,1.5*amp,0)],color=(.3,.3,.3))
        c1z=curve(pos=[(-8*pi,0,-1.5*amp),(-8*pi,0,1.5*amp)],color=(.3,.3,.3))
        c2y=curve(pos=[(8*pi,-1.5*amp,0),(8*pi,1.5*amp,0)],color=(.3,.3,.3))
        c2z=curve(pos=[(8*pi,0,-1.5*amp),(8*pi,0,1.5*amp)],color=(.3,.3,.3))
        self.axes=[sq1,sq2,axis,c1y,c1z,c2y,c2z]    
        self.arr1a=arrow(pos=(-8*pi,0,0),axis=(0,0,0),color=color.red,shaftwidth=0.3,fixedwidth=1)
        self.arr2a=arrow(pos=(-8*pi,0,0),axis=(0,0,0),color=color.green,shaftwidth=0.3,fixedwidth=1)
        self.arrsa=arrow(pos=(-8*pi,0,0),axis=(0,0,0),color=color.cyan,shaftwidth=0.5,fixedwidth=1)
        self.sl1a=curve(pos=(-8*pi,0,0),color=color.yellow,visible=0)
        self.sl2a=curve(pos=(-8*pi,0,0),color=color.yellow,visible=0)

        self.arr1b=arrow(pos=(8*pi,0,0),axis=(0,0,0),color=color.red,shaftwidth=0.3,fixedwidth=1)
        self.arr2b=arrow(pos=(8*pi,0,0),axis=(0,0,0),color=color.green,shaftwidth=0.3,fixedwidth=1)
        self.arrsb=arrow(pos=(8*pi,0,0),axis=(0,0,0),color=color.cyan,shaftwidth=0.5,fixedwidth=1)
        self.sl1b=curve(pos=(8*pi,0,0),color=color.yellow,visible=0)
        self.sl2b=curve(pos=(8*pi,0,0),color=color.yellow,visible=0)

        self.ampli2.set(5)
        self.wwll2.set(4)
        self.phase.set(0)
        self.matlen.set(16)

        self.mat=curve(pos=box(self.matlen.get()*pi/2,12,12),color=color.orange,visible=1)

    def SetupScene(self):
        
        
        step=pi/18
        pih=pi/2
        x=arange(-8*pi,8*pi+step,step)
        
        t=0.0

        pMatOn=self.MatOn.get()
        pmatlen=self.matlen.get()

        ibefore=int(144.0-4.5*pmatlen)
        iafter=int(144.0+4.5*pmatlen)
        xbefore=x[:ibefore]
        xbetween=x[ibefore:iafter]
        xafter=x[iafter:]
        
        # equations for extinction
        # E**E=E0**E0*exp(-eps*l)
        # E=sqrt(E0**E0*exp(-eps*l))
        # E=E0*exp(-0.5*eps*l)
        #
        # equations for refringence
        # wavelength_in_vacuum*frequency*2*pi=speed_in_vacuum
        # refraction index n=speed_in_vacuum/speed_in_matter, so speed_in_matter=speed_in_vacuum/n
        # frequency remains constant
        # so wavelength_in_matter*frequency*2pi=speed_in_vacuum/n
        # ie wavelength_in_matter*frequency*2pi=wavelength_in_vacuum*frequency*2pi/n
        # ie wavelength_in_matter=wavelength_in_vacuum/n

        # in x=xbetween[0], sin(x/wale1*n1-freq1*t+xd1a) = sin(x/wale1-freq1*t)
        # x/wale1*n1-freq1*t+xd1a=x/wale1-freq1*t
        # x/wale1*n1+xd1a=x/wale1
        # xd1a=x/wale1-x/wale1*n1
        # xd1a=x/wale1*(1-n1)
        #
        # in x=xafter[0], sin(x/wale1-freq1*t+xd1b) = sin(x/wale1*n1-freq1*t+xd1a)
        # xd1b=x/wale1*n1-x/wale1+xd1a
        # xd1b=x/wale1*(n1-1)+xd1a

        while 1:
            rate(self.arate.get())
            wale1=self.wwll1.get()*(10**(-9))
            wale2=self.wwll2.get()*(10**(-9))
            freq1=1.0/wale1
            freq2=1.0/wale2
            amp1=self.ampli1.get()
            amp2=self.ampli2.get()
            pdif=self.phase.get()/180.0*pi
            cMatOn=self.MatOn.get()
	    
            if pMatOn!=cMatOn:
                self.mat.visible=cMatOn
                pMatOn=cMatOn
            cmatlen=self.matlen.get()
            if pmatlen!=cmatlen:
                self.mat.pos=box(cmatlen*pi/2,12,12)
                ibefore=int(144.0-4.5*cmatlen)
                iafter=int(144.0+4.5*cmatlen)
                xbefore=x[:ibefore]
                xbetween=x[ibefore:iafter]
                xafter=x[iafter:]
                pmatlen=cmatlen
            if cMatOn:
                e1=self.w1e.get()
                n1=self.w1n.get()
                xd1a=xbetween[0]/wale1*(1-n1)
                xd1b=xafter[0]/wale1*(n1-1)+xd1a
                e2=self.w2e.get()
                n2=self.w2n.get()
                xd2a=xbetween[0]/wale2*(1-n2)
                xd2b=xafter[0]/wale2*(n2-1)+xd2a
            if self.Wa1On.get():
                self.w1.visible=1-self.hid.get()
                w1typ=self.w1type.get()
                if cMatOn:
                    if w1typ=="Horizontal":
                        zbefore=amp1*sin(xbefore/wale1-freq1*t)
                        zbetween=amp1*exp(e1*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale1*n1-freq1*t+xd1a)
                        zafter=amp1*exp(e1*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale1-freq1*t+xd1b)
                        self.w1.z=concatenate((zbefore,zbetween,zafter))
                        self.w1.y=0.0
                    elif w1typ=="Vertical":
                        ybefore=amp1*sin(xbefore/wale1-freq1*t)
                        ybetween=amp1*exp(e1*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale1*n1-freq1*t+xd1a)
                        yafter=amp1*exp(e1*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale1-freq1*t+xd1b)
                        self.w1.y=concatenate((ybefore,ybetween,yafter))
                        self.w1.z=0.0
                    elif w1typ=="Right circular":
                        zbefore=amp1*sin(xbefore/wale1-freq1*t)
                        zbetween=amp1*exp(e1*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale1*n1-freq1*t+xd1a)
                        zafter=amp1*exp(e1*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale1-freq1*t+xd1b)
                        self.w1.z=concatenate((zbefore,zbetween,zafter))
                        ybefore=amp1*sin(xbefore/wale1-freq1*t+pih)
                        ybetween=amp1*exp(e1*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale1*n1-freq1*t+xd1a+pih)
                        yafter=amp1*exp(e1*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale1-freq1*t+xd1b+pih)
                        self.w1.y=concatenate((ybefore,ybetween,yafter))
                    elif w1typ=="Left circular":
                        zbefore=amp1*sin(xbefore/wale1-freq1*t)
                        zbetween=amp1*exp(e1*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale1*n1-freq1*t+xd1a)
                        zafter=amp1*exp(e1*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale1-freq1*t+xd1b)
                        self.w1.z=concatenate((zbefore,zbetween,zafter))
                        ybefore=amp1*sin(xbefore/wale1-freq1*t-pih)
                        ybetween=amp1*exp(e1*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale1*n1-freq1*t+xd1a-pih)
                        yafter=amp1*exp(e1*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale1-freq1*t+xd1b-pih)
                        self.w1.y=concatenate((ybefore,ybetween,yafter))
                else:
                    if w1typ=="Horizontal":
                        self.w1.z=self.ampli1.get()*sin(x/wale1-freq1*t)
                        self.w1.y=0.0
                    elif w1typ=="Vertical":
                        self.w1.z=0.0
                        self.w1.y=self.ampli1.get()*sin(x/wale1-freq1*t)
                    elif w1typ=="Right circular":
                        self.w1.z=self.ampli1.get()*sin(x/wale1-freq1*t)
                        self.w1.y=self.ampli1.get()*sin(x/wale1-freq1*t+pih)
                    elif w1typ=="Left circular":
                        self.w1.z=self.ampli1.get()*sin(x/wale1-freq1*t)
                        self.w1.y=self.ampli1.get()*sin(x/wale1-freq1*t-pih)
                self.arr1a.visible=1
                self.arr1a.axis=(0,self.w1.y[0],self.w1.z[0])
                self.arr1b.visible=1
                self.arr1b.axis=(0,self.w1.y[-1],self.w1.z[-1])

            else:
                self.SumOn.set(0) # if wave1 is off, turn off the sum wave
                self.w1.z=0.0
                self.w1.y=0.0
                self.w1.visible=0
                self.arr1a.visible=0
                self.arr1b.visible=0
            if self.Wa2On.get():
                self.w2.visible=1-self.hid.get()
                w2typ=self.w2type.get()
                if cMatOn:
                    if w2typ=="Horizontal":
                        zbefore=amp2*sin(xbefore/wale2-freq2*t+pdif)
                        zbetween=amp2*exp(e2*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale2*n2-freq2*t+xd2a+pdif)
                        zafter=amp2*exp(e2*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale2-freq2*t+xd2b+pdif)
                        self.w2.z=concatenate((zbefore,zbetween,zafter))
                        self.w2.y=0.0
                    elif w2typ=="Vertical":
                        ybefore=amp2*sin(xbefore/wale2-freq2*t+pdif)
                        ybetween=amp2*exp(e2*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale2*n2-freq2*t+xd2a+pdif)
                        yafter=amp2*exp(e2*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale2-freq2*t+xd2b+pdif)
                        self.w2.y=concatenate((ybefore,ybetween,yafter))
                        self.w2.z=0.0
                    elif w2typ=="Right circular":
                        zbefore=amp2*sin(xbefore/wale2-freq2*t+pdif)
                        zbetween=amp2*exp(e2*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale2*n2-freq2*t+xd2a+pdif)
                        zafter=amp2*exp(e2*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale2-freq2*t+xd2b+pdif)
                        self.w2.z=concatenate((zbefore,zbetween,zafter))
                        ybefore=amp2*sin(xbefore/wale2-freq2*t+pih+pdif)
                        ybetween=amp2*exp(e2*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale2*n2-freq2*t+xd2a+pih+pdif)
                        yafter=amp2*exp(e2*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale2-freq2*t+xd2b+pih+pdif)
                        self.w2.y=concatenate((ybefore,ybetween,yafter))
                    elif w2typ=="Left circular":
                        zbefore=amp2*sin(xbefore/wale2-freq2*t+pdif)
                        zbetween=amp2*exp(e2*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale2*n2-freq2*t+xd2a+pdif)
                        zafter=amp2*exp(e2*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale2-freq2*t+xd2b+pdif)
                        self.w2.z=concatenate((zbefore,zbetween,zafter))
                        ybefore=amp2*sin(xbefore/wale2-freq2*t-pih+pdif)
                        ybetween=amp2*exp(e2*(xbetween[0]-xbetween)/pi)*sin(xbetween/wale2*n2-freq2*t+xd2a-pih+pdif)
                        yafter=amp2*exp(e2*(xbetween[0]-xafter[0])/pi)*sin(xafter/wale2-freq2*t+xd2b-pih+pdif)
                        self.w2.y=concatenate((ybefore,ybetween,yafter))
                else:
                    if w2typ=="Horizontal":
                        self.w2.z=self.ampli2.get()*sin(x/wale2-freq2*t+pdif)
                        self.w2.y=0.0
                    elif w2typ=="Vertical":
                        self.w2.z=0.0
                        self.w2.y=self.ampli2.get()*sin(x/wale2-freq2*t+pdif)
                    elif w2typ=="Right circular":
                        self.w2.z=self.ampli2.get()*sin(x/wale2-freq2*t+pdif)
                        self.w2.y=self.ampli2.get()*sin(x/wale2-freq2*t+pih+pdif)
                    elif w2typ=="Left circular":
                        self.w2.z=self.ampli2.get()*sin(x/wale2-freq2*t+pdif)
                        self.w2.y=self.ampli2.get()*sin(x/wale2-freq2*t-pih+pdif)
                self.arr2a.visible=1
                self.arr2a.axis=(0,self.w2.y[0],self.w2.z[0])
                self.arr2b.visible=1
                self.arr2b.axis=(0,self.w2.y[-1],self.w2.z[-1])
                
            else:
                self.w2.z=0.0
                self.w2.y=0.0
                self.w2.visible=0
                self.arr2a.visible=0
                self.arr2b.visible=0
                self.SumOn.set(0) # if wave2 is off, turn off the sum wave
            if self.SumOn.get():
                self.sc.visible=1-self.hid.get()
                self.sc.z=self.w1.z+self.w2.z
                self.sc.y=self.w1.y+self.w2.y
                #Er = 
                self.arrsa.visible=1
                self.arrsa.axis=(0,self.sc.y[0],self.sc.z[0])
                self.arrsb.visible=1
                self.arrsb.axis=(0,self.sc.y[-1],self.sc.z[-1])
                self.sl1a.visible=1
                self.sl1b.visible=1
                self.sl2a.visible=1
                self.sl2b.visible=1
                self.sl1a.pos=[(-8*pi,self.arr1a.axis.y,self.arr1a.axis.z),(-8*pi,self.arrsa.axis.y,self.arrsa.axis.z)]
                self.sl2a.pos=[(-8*pi,self.arr2a.axis.y,self.arr2a.axis.z),(-8*pi,self.arrsa.axis.y,self.arrsa.axis.z)]
                self.sl1b.pos=[(8*pi,self.arr1b.axis.y,self.arr1b.axis.z),(8*pi,self.arrsb.axis.y,self.arrsb.axis.z)]
                self.sl2b.pos=[(8*pi,self.arr2b.axis.y,self.arr2b.axis.z),(8*pi,self.arrsb.axis.y,self.arrsb.axis.z)]
            else:
                self.sc.visible=0
                self.arrsa.visible=0
                self.arrsb.visible=0
                self.sl1a.visible=0
                self.sl2a.visible=0
                self.sl1b.visible=0
                self.sl2b.visible=0
            E1 = sqrt ((self.w1.y[-1]*self.w1.y[-1]) + (self.w1.z[-1]*self.w1.z[-1]))
	    E2 = sqrt ((self.w2.y[-1]*self.w2.y[-1]) + (self.w2.z[-1]*self.w2.z[-1]))
            
            self.te.config(state=NORMAL)
	    self.te.delete('1.0',END)
	    	            
            if (self.w1type.get()=="Left circular") & (self.w2type.get()=="Right circular"):
			self.te.insert(END,'wavelength = '+str(self.wwll1.get())+' nm\nellipticity of the polarisation = '+str( round(((E2-E1)/(E1+E2)),4) ))
            elif (self.w2type.get()=="Left circular") & (self.w1type.get()=="Right circular"):
			self.te.insert(END,'wavelength = '+str(self.wwll1.get())+' nm\nellipticity of the polarisation = '+str( round(((E1-E2)/(E1+E2)),4) ))
	    else:
			self.te.insert(END,'a plane polarised should be the superposition of two circularly polarised wave in opposite orientation' )
            self.te.config(state=DISABLED)
            t=t+step

app=Application()
app.mainloop()
