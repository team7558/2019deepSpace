/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.PIDSubsystem;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import frc.robot.RobotMap;
/**
 * Add your docs here.
 */
public class Wrist extends PIDSubsystem { 
  public CANSparkMax m_wristMotor;
  public CANEncoder m_wristEncoder;
  
  public Wrist(){
    m_wristMotor = new VictorSPX(RobotMap.WRIST_MOTOR);
  }
  // Put methods for controlling this subsystem
  // here. Call these from Commands.

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  public void driveWrist(double speed){
    m_wristMotor.set(ControlMode.PercentOutput, speed);
  }

  public void stop(){
    m_wristMotor.set(ControlMode.PercentOutput, 0);
  }

  public double getWristSpeed(){
    return m_wristMotor.getMotorOutputPercent();
  }

}
