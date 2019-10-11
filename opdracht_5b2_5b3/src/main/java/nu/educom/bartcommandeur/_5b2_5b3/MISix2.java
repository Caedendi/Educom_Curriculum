package nu.educom.bartcommandeur._5b2_5b3;

import nu.educom.bartcommandeur._5b2_5b3.views.IMISixInput;
import nu.educom.bartcommandeur._5b2_5b3.views.ConsoleView;
import nu.educom.bartcommandeur._5b2_5b3.views.SwingJOptionView;
import nu.educom.bartcommandeur._5b2_5b3.views.SwingJFrameView;
import nu.educom.bartcommandeur._5b2_5b3.presenters.MISixPresenter;

public class MISix2 {
    public static void main(String[] args) {
        IMISixInput view = null;
        if (args.length > 0) {
            switch (args[0]){
                case "console": view = new ConsoleView(); break;
                case "joption": view = new SwingJOptionView(); break;
                case "jframe": view = new SwingJFrameView(); break;
                default:
                    System.out.printf("Use options: console, joption or jframe");
                    System.exit(-1);
                    break;
            }
        } else {
            // Default if no arguments are given
            view = new SwingJFrameView();
        }
        MISixPresenter presenter = new MISixPresenter(view);
        presenter.run();
    }
}