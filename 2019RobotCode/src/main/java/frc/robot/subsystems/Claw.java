/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;

import com.ctre.phoenix.motorcontrol.can.WPI_VictorSPX;

import edu.wpi.first.wpilibj.Solenoid;
import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class Claw extends Subsystem {
  private WPI_VictorSPX m_intake_1, m_intake_2;
  private Solenoid m_solenoid_1; // Cargo 
  private Solenoid m_solenoid_2; // Hatch 

  public Claw(){
    m_intake_1 = new WPI_VictorSPX(RobotMap.INTAKE_1);
    m_intake_2 = new WPI_VictorSPX(RobotMap.INTAKE_2);
    //m_solenoid_1 = new Solenoid(RobotMap.SOLENOID_1);
    //m_solenoid_2 = new Solenoid(RobotMap.SOLENOID_2);
  }
  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  public void cargoIntake(){
    m_intake_1.set(-0.2);
    m_intake_2.set(0.2);
  }

  public void shootCargo(){
    m_intake_1.set(0.2);
    m_intake_2.set(-0.2);
    // This might not work
    //if (m_intake_1.getMotorOutputPercent() >= 0.95 && m_intake_2.getMotorOutputPercent() >= 0.95) {
    //  m_solenoid_1.set(true);
    //}
  }
  public void stopShootCargo(){
    m_intake_1.set(0);
    m_intake_2.set(0);
    //m_solenoid_1.set(false);
  }

  public void extendHatch(){
    m_solenoid_2.set(true);

  }

  public void retractHatch(){
    m_solenoid_2.set(false);
  }

}
