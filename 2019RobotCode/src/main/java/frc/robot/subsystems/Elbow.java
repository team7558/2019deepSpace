package frc.robot.subsystems;

import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import frc.robot.RobotMap;

public class Elbow extends PIDMotorJoint {
    public Elbow(){
        super("elbow", new CANSparkMax(RobotMap.ELBOW_MOTOR, MotorType.kBrushless), 0.82751878, 130, -46, -35, 0.0075, 0, 0, true, 0.5, 33, 0,1);
    }
}