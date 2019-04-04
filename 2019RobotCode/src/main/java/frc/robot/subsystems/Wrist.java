package frc.robot.subsystems;

import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import frc.robot.RobotMap;

public class Wrist extends PIDMotorJoint {
  
  public Wrist(){
    super("wrist", new CANSparkMax(RobotMap.WRIST_MOTOR, MotorType.kBrushless), 0.26269688, 140, -140, 111, 0.004, 0, 0, true, 0.1, 50,RobotMap.FRONT_WRIST_SWITCH,RobotMap.BACK_WRIST_SWITCH);
  }

}
