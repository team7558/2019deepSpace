package frc.robot.subsystems;

import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import frc.robot.RobotMap;

public class Elbow extends PIDMotorJoint {
    public Elbow(){
        super("elbow", new CANSparkMax(RobotMap.ELBOW_MOTOR1, MotorType.kBrushless), new CANSparkMax(RobotMap.ELBOW_MOTOR2, MotorType.kBrushless), 0.82751878, 95, -46, 110, 0.012, 0, 0, true, 0.4, 33, RobotMap.FRONT_ELBOW_SWITCH,RobotMap.BACK_ELBOW_SWITCH);
    }
}
