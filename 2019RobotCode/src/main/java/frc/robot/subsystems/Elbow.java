package frc.robot.subsystems;

import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import frc.robot.RobotMap;

public class Elbow extends PIDMotorJoint {
    public Elbow(){
        super("elbow", new CANSparkMax(RobotMap.ELBOW_MOTOR, MotorType.kBrushless), 0.82751878, 90, -5, -40, 0.01, 0, 0, true, 0.1, 20, 0,1);
    }
}