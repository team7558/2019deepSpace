/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;

import com.ctre.phoenix.motorcontrol.ControlMode;
import com.ctre.phoenix.motorcontrol.can.VictorSPX;
import frc.robot.RobotMap;
/**
 * Add your docs here.
 */
public class Wrist extends Subsystem {
  public VictorSPX m_wristMotor;
  
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
