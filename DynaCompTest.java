import java.net.URI;

import javax.tools.SimpleJavaFileObject;
import javax.tools.JavaFileObject.Kind;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.OutputStream;

public class DynaCompTest {

	public static void main(String args[]){
		String className = args[0];

		StringBuilder src = new StringBuilder();

        src.append("public class DynaClass {\n");
        src.append("    public String toString() {\n");
        src.append("        return \"Hello, I am \" + ");
        src.append("this.getClass().getSimpleName();\n");
        src.append("    }\n");
        src.append("}\n");		

    	// src.println("public class" + className + "{");
    	// 	out.println("public static void main ( String args [] ) {");
    	// 				src.println(args[1]);
    	// 				src.println(args[2]);
    	// 				src.println(args[3]);
    	// 				src.println(args[4]);
    	// 	src.println("}");

    	// 	src.println(args[5]);
    	// src.println("}");

		JavaCompiler compiler = ToolProvider.getSystemJavaCompiler();
        JavaFileManager fileManager = new ClassFileManager(compiler.getStandardFileManager(null, null, null));

        List<JavaFileObject> jfiles = new ArrayList<JavaFileObject>();
        jfiles.add(new CharSequenceJavaFileObject(className, src));



 		compiler.getTask(null, fileManager, null, null, null, jfiles).call();


        Object instance = fileManager.getClassLoader(null).loadClass(className).newInstance();
        System.out.println(instance);

	}
}

public class CharSequenceJavaFileObject extends SimpleJavaFileObject {

    /**
    * CharSequence representing the source code to be compiled
    */
    private CharSequence content;

    /**
    * This constructor will store the source code in the
    * internal "content" variable and register it as a
    * source code, using a URI containing the class full name
    *
    * @param className
    *            name of the public class in the source code
    * @param content
    *            source code to compile
    */
    public CharSequenceJavaFileObject(String className,
        CharSequence content) {
        super(URI.create("string:///" + className.replace('.', '/')
            + Kind.SOURCE.extension), Kind.SOURCE);
        this.content = content;
    }

    /**
    * Answers the CharSequence to be compiled. It will give
    * the source code stored in variable "content"
    */
    @Override
    public CharSequence getCharContent(
        boolean ignoreEncodingErrors) {
        return content;
    }
}

public class JavaClassObject extends SimpleJavaFileObject {

    /**
    * Byte code created by the compiler will be stored in this
    * ByteArrayOutputStream so that we can later get the
    * byte array out of it
    * and put it in the memory as an instance of our class.
    */
    protected final ByteArrayOutputStream bos =
        new ByteArrayOutputStream();

    /**
    * Registers the compiled class object under URI
    * containing the class full name
    *
    * @param name
    *            Full name of the compiled class
    * @param kind
    *            Kind of the data. It will be CLASS in our case
    */
    public JavaClassObject(String name, Kind kind) {
        super(URI.create("string:///" + name.replace('.', '/')
            + kind.extension), kind);
    }

    /**
    * Will be used by our file manager to get the byte code that
    * can be put into memory to instantiate our class
    *
    * @return compiled byte code
    */
    public byte[] getBytes() {
        return bos.toByteArray();
    }

    /**
    * Will provide the compiler with an output stream that leads
    * to our byte array. This way the compiler will write everything
    * into the byte array that we will instantiate later
    */
    @Override
    public OutputStream openOutputStream() throws IOException {
        return bos;
    }
}

public class ClassFileManager extends
		ForwardingJavaFileManager {
    /**
    * Instance of JavaClassObject that will store the
    * compiled bytecode of our class
    */
    private JavaClassObject jclassObject;

    /**
    * Will initialize the manager with the specified
    * standard java file manager
    *
    * @param standardManger
    */
    public ClassFileManager(StandardJavaFileManager
        standardManager) {
        super(standardManager);
    }

    /**
    * Will be used by us to get the class loader for our
    * compiled class. It creates an anonymous class
    * extending the SecureClassLoader which uses the
    * byte code created by the compiler and stored in
    * the JavaClassObject, and returns the Class for it
    */
    @Override
    public ClassLoader getClassLoader(Location location) {
        return new SecureClassLoader() {
            @Override
            protected Class<?> findClass(String name)
                throws ClassNotFoundException {
                byte[] b = jclassObject.getBytes();
                return super.defineClass(name, jclassObject
                    .getBytes(), 0, b.length);
            }
        };
    }

    /**
    * Gives the compiler an instance of the JavaClassObject
    * so that the compiler can write the byte code into it.
    */
    @Override
    public JavaFileObject getJavaFileForOutput(Location location,
        String className, Kind kind, FileObject sibling)
            throws IOException {
            jclassObject = new JavaClassObject(className, kind);
        return jclassObject;
    }
}