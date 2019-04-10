/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import com.ctre.phoenix.motorcontrol.can.WPI_VictorSPX;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;

import edu.wpi.first.wpilibj.command.Subsystem;
import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class Intake extends Subsystem {
  // Put methods for controlling this subsystem
  // here. Call these from Commands.

  private WPI_VictorSPX m_topRollers, m_bottomRollers;

  public Intake(){
    m_topRollers = new WPI_VictorSPX(RobotMap.INTAKE_TOP_ROLLERS);
    m_bottomRollers = new WPI_VictorSPX(RobotMap.INTAKE_BOTTOM_ROLLERS);
  }

  public void shoot(double speed){
    m_topRollers.set(-speed);
    m_bottomRollers.set(-speed);
  }
  
  public void center(double speed){
    m_topRollers.set(speed);
    m_bottomRollers.set(-0.2*speed);
  }

  public void intake(double speed){
    m_topRollers.set(speed);
    m_bottomRollers.set(speed);
  }

  public void stop(){
    m_topRollers.set(0);
    m_bottomRollers.set(0);
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }
}
