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

  private WPI_VictorSPX m_intake_1, m_intake_2, m_suction;
  private Solenoid m_shooter;
  public double m_startTime;

  public Claw(){
    m_intake_1 = new WPI_VictorSPX(RobotMap.INTAKE_1);
    m_intake_2 = new WPI_VictorSPX(RobotMap.INTAKE_2);
    m_suction = new WPI_VictorSPX(RobotMap.HATCH_SUCTION);
    m_shooter = new Solenoid(RobotMap.SHOOTING_PISTON);
    m_startTime = Timer.getFPGATimestamp();
  }

  @Override
  public void initDefaultCommand() {
  }

  public void cargoIntake(){
    m_shooter.set(false);
    m_intake_1.set(0.75);
    m_intake_2.set(-0.75);
  }

  public void shootCargo(double speed){
    if (Timer.getFPGATimestamp() - m_startTime > 1){
      m_shooter.set(true);
    } else {
      m_shooter.set(false);
    }
    m_intake_1.set(-speed);
    m_intake_2.set(speed);
  }
  public void stopShootCargo(){
    m_shooter.set(false);
    m_intake_1.set(0);
    m_intake_2.set(0);
  }

  public void suckHatch(){
    m_suction.set(1);
  }

  public void releaseHatch(){
    m_suction.set(0);
  }

}
