package nu.educom.bartcommandeur._5b2;

import nu.educom.bartcommandeur._5b2.views.IMISixInput;
import nu.educom.bartcommandeur._5b2.views.ConsoleView;
import nu.educom.bartcommandeur._5b2.views.SwingJOptionView;
import nu.educom.bartcommandeur._5b2.views.SwingJFrameView;
import nu.educom.bartcommandeur._5b2.presenters.MISixPresenter;

import javax.swing.*;

public class MISix2 {
    public static void main(String[] args) {
        /* JH: Je moet invoke later alleen gebruiken voor kleine functies die de GUI updaten, niet voor de hele applicatie
               zie: https://www.javamex.com/tutorials/threads/invokelater.shtml
         */
//        SwingUtilities.invokeLater(new Runnable() {
//            @Override
//            public void run() {
//                    IMISixInput view = new ConsoleView();
//                    IMISixInput view = new SwingJOptionView();
                    IMISixInput view = new SwingJFrameView();
                    /* JH TIP: Je kan args gebruiken om te switchen tussen de verschillende views, in 'edit Configurations' maak je 2 kopieen van MISix2 en
                               deze noem je MISix2.Console en MISix2.JOption en dan kan je bij "program parameters" respectievelijk console en jOption invullen:


                        IMISixInput view = null;
                      if (args.length > 0) {
                           switch (args[0]){
                             case "console": view = new ConsoleView(); break;
                             case "jOption": view = new SwingJOptionView(); break;
                             case "jFrame": view = new SwingJFrameView(); break;
                             default:
                                 System.out.printf("Use options: console, jOption or jFrame");
                                 System.exit(-1);
                                 break;
                           }
                        } else {
                          // Default if no arguments are given
                          view = new SwingJFrameView();
                        }
                    */
                    MISixPresenter presenter = new MISixPresenter(view);
                    presenter.run();
//            }
//        });
    }
}