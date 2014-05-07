import java.io.IOException;
import java.io.PrintWriter;
import java.io.StringWriter;
import java.lang.reflect.InvocationTargetException;
import java.net.URI;
import java.util.Arrays;

import javax.tools.Diagnostic;
import javax.tools.DiagnosticCollector;
import javax.tools.JavaCompiler;
import javax.tools.JavaFileObject;
import javax.tools.SimpleJavaFileObject;
import javax.tools.ToolProvider;
import javax.tools.JavaCompiler.CompilationTask;
import javax.tools.JavaFileObject.Kind;


import java.lang.Math.*;


public class test{

	public static void main(String args[]){

   		JavaCompiler compiler = ToolProvider.getSystemJavaCompiler();
    	StringWriter writer = new StringWriter();
    	PrintWriter out = new PrintWriter(writer);
    	DiagnosticCollector<JavaFileObject> diagnostics = new DiagnosticCollector<JavaFileObject>();


    	out.println("public class test2 {");
    		out.println("public static void main ( String args [] ) {");
    					out.println(args[0]);
    					out.println(args[1]);
    					out.println(args[2]);
    					out.println(args[3]);
    		out.println("}");

    		out.println(args[4]);
    	out.println("}");


    	out.close();

    	JavaFileObject file = new JavaSourceFromString("test2", writer.toString());

  		Iterable<? extends JavaFileObject> compilationUnits = Arrays.asList(file);
   		CompilationTask task = compiler.getTask(null, null, diagnostics, null, null, compilationUnits);


	    boolean success = task.call();
	    for (Diagnostic diagnostic : diagnostics.getDiagnostics()) {
	      System.out.println(diagnostic.getCode());
	      System.out.println(diagnostic.getKind());
	      System.out.println(diagnostic.getPosition());
	      System.out.println(diagnostic.getStartPosition());
	      System.out.println(diagnostic.getEndPosition());
	      System.out.println(diagnostic.getSource());
	      System.out.println(diagnostic.getMessage(null));

	    }
	    System.out.println("Success: " + success);

	    if (success) {
	      try {
	        Class.forName("test2").getDeclaredMethod("main", new Class[] { String[].class })
	            .invoke(null, new Object[] { null });
	      } catch (ClassNotFoundException e) {
	        System.err.println("Class not found: " + e);
	      } catch (NoSuchMethodException e) {
	        System.err.println("No such method: " + e);
	      } catch (IllegalAccessException e) {
	        System.err.println("Illegal access: " + e);
	      } catch (InvocationTargetException e) {
	        System.err.println("Invocation target: " + e);
	      }
	    }   		

	} 


}


class JavaSourceFromString extends SimpleJavaFileObject {
  final String code;

  JavaSourceFromString(String name, String code) {
    super(URI.create("string:///" + name.replace('.','/') + Kind.SOURCE.extension),Kind.SOURCE);
    this.code = code;
  }

  @Override
  public CharSequence getCharContent(boolean ignoreEncodingErrors) {
    return code;
  }
}