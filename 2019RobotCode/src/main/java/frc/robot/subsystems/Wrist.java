package frc.robot.subsystems;

import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import frc.robot.RobotMap;

public class Wrist extends PIDMotorJoint {
  
  public Wrist(){
    super("wrist", new CANSparkMax(RobotMap.WRIST_MOTOR, MotorType.kBrushless), 0.26269688, 45, -90, 0, 0.015, 0, 0, true, 0.2, 50,2,3);
  }

}
