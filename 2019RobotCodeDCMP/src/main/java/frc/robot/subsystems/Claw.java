/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.Solenoid;
import edu.wpi.first.wpilibj.Timer;
import edu.wpi.first.wpilibj.command.Subsystem;
import com.ctre.phoenix.motorcontrol.can.WPI_VictorSPX;

import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class Claw extends Subsystem {

  private WPI_VictorSPX m_intake_1, m_intake_2;
  private Solenoid m_hatchShooter, m_hatchExtender;
  public double m_startTime;
  public double SHOOT_SPEED = 0.4;
  public static double INTAKE_SPEED = 0.8;

  public Claw(){
    m_intake_1 = new WPI_VictorSPX(RobotMap.INTAKE_1);
    m_intake_2 = new WPI_VictorSPX(RobotMap.INTAKE_2);
    m_hatchShooter = new Solenoid(RobotMap.SHOOT_HATCH);
    m_hatchExtender = new Solenoid(RobotMap.EXTEND_HATCH);
    m_startTime = Timer.getFPGATimestamp();
  }

  @Override
  public void initDefaultCommand() {
  }

  public void cargoIntake(double speed){
    if (speed > INTAKE_SPEED){
      speed = INTAKE_SPEED;
    }
    m_intake_1.set(speed);
    m_intake_2.set(-speed);
  }

  public void shootCargo(double speed){
    if (speed > SHOOT_SPEED){
      speed = SHOOT_SPEED;  
    }
    m_intake_1.set(-speed);
    m_intake_2.set(speed);
  }
  public void stopShootCargo(){
    m_intake_1.set(0);
    m_intake_2.set(0);
  }

  public void extendHatch(){
    m_hatchExtender.set(true);
  }
  public void retractHatch(){
    m_hatchExtender.set(false);
  }
  public void shootHatch(){
    m_hatchShooter.set(true);
  }
  public void intakeHatch(){
    m_hatchShooter.set(false);
  }

}
