package nu.educom.bartcommandeur._5b2;

import nu.educom.bartcommandeur._5b2.views.IMISixInput;
import nu.educom.bartcommandeur._5b2.views.ConsoleView;
import nu.educom.bartcommandeur._5b2.views.SwingJOptionView;
import nu.educom.bartcommandeur._5b2.views.SwingJFrameView;
import nu.educom.bartcommandeur._5b2.presenters.MISixPresenter;

import javax.swing.*;

public class MISix2 {
    public static void main(String[] args) {
//        SwingUtilities.invokeLater(new Runnable() {
//            @Override
//            public void run() {
//                    IMISixInput view = new ConsoleView();
//                    IMISixInput view = new SwingJOptionView();
                    IMISixInput view = new SwingJFrameView();

                    MISixPresenter presenter = new MISixPresenter(view);
                    presenter.run();
//            }
//        });
    }
}