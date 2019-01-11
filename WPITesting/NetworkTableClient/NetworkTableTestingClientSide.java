import edu.wpi.first.networktables.NetworkTable;
import edu.wpi.first.networktables.NetworkTableEntry;
import edu.wpi.first.networktables.NetworkTableInstance;

public class NetworkTableTestingClientSide {
    public static void main(String[] args){
        new NetworkTableTestingClientSide().run();
    }

    public void run(){
        NetworkTableInstance inst = NetworkTableInstance.getDefault();
        NetworkTable table = inst.getTable("datatable");
        NetworkTableEntry xEntry = table.getEntry("X");
        NetworkTableEntry yEntry = table.getEntry("Y");
        inst.startClientTeam(7558);
        inst.startDSClient();
        while (true){
            try {
                Thread.sleep(1000);
            } catch (InterruptedException ex){
                System.out.println("interrupted");
                return;
            }
            double x = xEntry.getDouble(0.0);
            double y = yEntry.getDouble(0.0);
            System.out.println("X: "+ x + " Y:" + y);
        }
    }
}