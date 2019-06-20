import com.sun.jna.Library;
import com.sun.jna.Native;
import com.sun.jna.Platform;

/** Simple example of native library declaration and usage. */
public class jnaTest {
    public interface CLibrary extends Library {
        CLibrary INSTANCE = (CLibrary) Native.loadLibrary(
            (Platform.isWindows() ? "msvcrt" : "c"), CLibrary.class);
        void printf(String format, Object... args);
    }

    public static void main(String[] args) 
    {
        String[] as={"hello","hi","I am a native test array","etc" };
        CLibrary.INSTANCE.printf("Hello, World\n"+as.length);
        for (int i = 0; i < as.length; i++) {
            CLibrary.INSTANCE.printf("Argument %d: %s\n", i, as[i]);
        }
    }
}